<?php
namespace App\Models\Abstracts;

use Contracts\ResponseResolver;
use Psr\Http\Message\ResponseInterface;
use App\Exceptions\RestApi\ExistRestApiException;
use App\Exceptions\RestApi\UnknownRestApiException;
use App\Exceptions\RestApi\NotFoundRestApiException;
use App\Exceptions\RestApi\AuthorizeRestApiException;
use App\Exceptions\RestApi\UndefinedRestApiException;
use App\Exceptions\RestApi\StatusCodeRestApiException;
use App\Exceptions\RestApi\ResponseFormatRestApiException;
use App\Exceptions\RestApi\InvalidParameterRestApiException;

class PhpRestResponseResolver implements ResponseResolver
{
    public function resolve(ResponseInterface $response)
    {
        if (!in_array($response->getStatusCode(), [200, 400, 500])) {
            throw new StatusCodeRestApiException($response->getStatusCode());
        }
        $body = $response->getBody();
        $data = json_decode($body, true);
        if (null === $data) {
            throw new ResponseFormatRestApiException($body);
        }
        if (! array_key_exists('code', $data) || ! array_key_exists('data', $data)) {
            throw new ResponseFormatRestApiException($body);
        }
        switch ($data['code']) {
        case 0:
            return $data['data'];
        default:
            throw new UndefinedRestApiException($data['code']);
        }
    }

}
