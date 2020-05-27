<?php
namespace App\Models;

use Log;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\Logic\ExistBackendException;
use App\Exceptions\Logic\NotFoundBackendException;
use App\Exceptions\Logic\ParameterBackendException;
use App\Exceptions\Server\UnknownBackendException;
use App\Exceptions\Server\UndefinedBackendException;
use App\Exceptions\Server\StatusCodeBackendException;
use App\Exceptions\Logic\AuthorizationBackendException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\Server\ResponseFormatBackendException;

abstract class JavaRestModel extends Model
{
    CONST PREFIX_PATH_PARAM = ':';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected static $keyNameInPath = 'id';

    protected static $apiTimeout = 3000;

    protected static $defaultHeaders = [
        'Content-Type' => 'application/json',
    ];


    /*
     * The definition map of apis.
     * format:
     * [
     *     'paginate' => ['method' => 'GET',    'path' => '/users'],
     *     'retrieve' => ['method' => 'GET',    'path' => '/users/:guid'],
     *     'create'   => ['method' => 'POST',   'path' => '/users/:guid'],
     *     'update'   => ['method' => 'PUT',    'path' => '/users/:guid'],
     *     'delete'   => ['method' => 'DELETE', 'path' => '/users/:guid'],
     * ]
     */
    protected static $apiMap = [];

    abstract protected static function getBaseUri();

    /**
     * Get an object.
     *
     * @param $name
     * @param array $queryParams
     * @param null $body
     * @param array $headers
     * @return null|static
     */
    static public function getItem($name, $queryParams = [], $body = null, $headers = [])
    {
        $response = static::callRemoteApi($name, $queryParams, $body, $headers);
        try {
            $data = static::getResponseData($response);
        } catch (NotFoundBackendException $e) {
            return null;
        }

        $obj = new static();
        $obj->forceFill($data);
        return $obj;
    }

    /**
     * Get a collection which may containt multiple models.
     *
     * @param $name
     * @param array $queryParams
     * @param null $body
     * @param array $headers
     * @return null|Illuminate\Support\Collection
     */
    static public function getCollection($name, $queryParams = [], $body = null, $headers = [])
    {
        $response = static::callRemoteApi($name, $queryParams, $body, $headers);
        try {
            $data = static::getResponseData($response);
        } catch (NotFoundBackendException $e) {
            return null;
        }

        $items = [];
        foreach ( $data as $item ) {
            $obj = new static();
            $obj->forceFill($item);
            $items[] = $obj;
        }

        return Collection::make($items);
    }

    /**
     *  Get a paginator.
     *
     * @param $name
     * @param array $queryParams
     * @param null $body
     * @param array $headers
     * @return null|Illuminate\Pagination\LengthAwarePaginator;
     */
    static public function getPaginator($name, $queryParams = [], $body = null, $headers = [])
    {
        $queryParams['pageNo'] = (isset($queryParams['page']) && !empty($queryParams['page']))  ? $queryParams['page'] : 1;
        $queryParams['pageSize'] = (isset($queryParams['per_page']) && !empty($queryParams['per_page']))  ? $queryParams['per_page'] : config('app.default_per_page');

        $response = static::callRemoteApi($name, $queryParams, $body, $headers);

        try {
            $data = static::getResponseData($response);
        } catch (NotFoundBackendException $e) {
            return null;
        }

        if ( !isset($data['result'])) {
            return new LengthAwarePaginator([], 0, $queryParams['pageSize'], $queryParams['pageNo']);
        }

        $items = [];
        foreach ( $data['result'] as $item ) {
            $obj = new static();
            $obj->forceFill($item);
            $items[] = $obj;
        }

        $total = $data['totalCount'];
        $perPage = $data['pageSize'];
        $page = $data['pageNo'];
        $lengthAwarePaginator = new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        return $lengthAwarePaginator;
    }

    /**
     * Create or update
     *
     * @param $name
     * @param array $queryParams
     * @param null $body
     * @param array $headers
     * @return bool|null
     */
    static public function getData($name, $queryParams = [], $body = null, $headers = [])
    {
        $response = static::callRemoteApi($name, $queryParams, $body, $headers);
        $data = static::getResponseData($response);

        return $data;
    }


    static protected function getResponseData($response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new StatusCodeBackendException($response->getStatusCode());
        }
        $data = json_decode($response->getBody(), true);
        if (null === $data) {
            throw new ResponseFormatBackendException();
        }
        if (! array_key_exists('code', $data) || ! array_key_exists('businessObj', $data)) {
            throw new ResponseFormatBackendException();
        }
        switch ($data['code']) {
            case 200:
                return $data['businessObj'];
            case 201:
                throw new NotFoundBackendException();
            case 300:
                throw new ExistBackendException();
            case 400:
                throw new ParameterBackendException();
            case 401:
                throw new AuthorizationBackendException();
            case 500:
                throw new UnknownBackendException($data['message'] ?: '');
            default:
                throw new UndefinedBackendException($data['code']);
        }
    }

    static protected function apiPath($name)
    {
        if ( !isset(static::$apiMap[$name]) || !isset(static::$apiMap[$name]['path'])) {
            throw new \UnexpectedValueException('Do not define the path for "' . $name . '"');
        }
        return static::$apiMap[$name]['path'];
    }

    static protected function apiMethod($name)
    {
        if ( !isset(static::$apiMap[$name]) || !isset(static::$apiMap[$name]['method'])) {
            throw new \UnexpectedValueException('Do not define the method for the "' . $name . '"');
        }
        return static::$apiMap[$name]['method'];
    }

    static protected function defaultToken()
    {
        return request()->header('Authorization', null);
    }

    static protected function defaultHeaders()
    {
        $defaultHeader = [
            'Authorization' => self::defaultToken()
        ];

        return $defaultHeaders = array_merge($defaultHeader, static::$defaultHeaders);
    }

    static protected function makeUrl($path, $args = [])
    {
        $pieces = explode('/', $path);
        foreach ( $pieces as $key => $piece ) {
            if ((strlen($piece) > 0) && ($piece[0] == static::PREFIX_PATH_PARAM)) {
                if ( !isset($args[$piece])) {
                    throw new \UnexpectedValueException('Do not found the parameter "' . $piece . '"');
                }
                $pieces[$key] = $args[$piece];
            }
        }
        $path = implode('/', $pieces);

        foreach ( $args as $key => $param ) {
            if ($key[0] == static::PREFIX_PATH_PARAM) {
                unset($args[$key]);
            }
        }

        if (count($args) <= 0) {
            return $path;
        }
        $queryString = http_build_query($args, '', '&', PHP_QUERY_RFC3986);
        return $path . '?' . $queryString;
    }

    static protected function callRemoteApi($name, $queryParams = [], $body = null, $headers = [])
    {
        $method = static::apiMethod($name);
        $url = static::makeUrl(static::apiPath($name), $queryParams);

        $client = new HttpClient([
            'base_uri'    => static::getBaseUri(),
            'timeout'     => static::$apiTimeout,
            'http_errors' => false,
        ]);

        $bodyString = null;

        if ($body) {
            if (is_string($body)) {
                $bodyString = $body;
            } else if (is_array($body)) {
                $bodyString = json_encode($body);
            } else if ($body instanceof Arrayable) {
                $bodyString = json_encode($body->toArray());
            } else {
                $bodyString = (string)$body;
            }
        }

        $headers = array_merge(static::defaultHeaders(), $headers);

        Log::debug("\nRestModel: \n\tHost: " . static::getBaseUri() . "\n\tURL: $url\n\tMethod: $method\n\tHeaders: \n" . var_export($headers, true) . "\n\tBody: $bodyString\n");

        $request = new Request($method, $url, $headers, $bodyString);

        return $client->send($request);
    }

}
