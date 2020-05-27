<?php
namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Support\MessageBag;

class AccessDetailLog
{
    protected $startTime = null;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);

        if (! $this->shouldIgnore($request)) {
            $this->startingLog($request);
        }

        $response = $next($request);

        if (! $this->shouldIgnore($request)) {
            $this->endingLog($response);
        }

        $this->spendingTimeLog($request);

        return $response;
    }


    protected function shouldIgnore($request)
    {
        $ignoreList = ['/api/api-status'];
        return in_array($request->path(), $ignoreList);
    }

    protected function startingLog($request)
    {
        $msgBag = new MessageBag();
        $msgBag->add('URL', $request->fullUrl());
        $msgBag->add('Method', $request->method());
        $msgBag->add('Content', $request->getContent());

        $this->loggingMessageBag($msgBag, '==================== Starting ====================');
    }

    protected function endingLog($response)
    {
        $msgBag = new MessageBag();
        $msgBag->add('Status Code', $response->getStatusCode());
        $msgBag->add('Headers', (string)$response->headers);
        $msgBag->add('Content', $response->getContent());

        $this->loggingMessageBag($msgBag, 'Response details', '==================== Ending ====================');
    }

    protected function spendingTimeLog($request)
    {
        if (is_null($this->startTime)) {
            return;
        }

        $endTime = microtime(true);

        Log::info(sprintf("%s %s Spend Time: %f seconds", $request->method(), $request->path(), $endTime - $this->startTime));
    }


    protected function loggingMessageBag(MessageBag $messageBag, $prefix = '', $suffix = '')
    {
        $lines = empty($prefix) ? '' : $prefix."\n";
        foreach ($messageBag->all(':key: :message') as $line) {
            $lines .= $line."\n";
        }
        $lines .= $suffix;
        Log::debug($lines);
    }

}

