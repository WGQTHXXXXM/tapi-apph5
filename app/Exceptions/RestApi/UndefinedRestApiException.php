<?php
namespace App\Exceptions\RestApi;

use Exception;
use App\Exceptions\RestApiException;

class UndefinedRestApiException extends RestApiException
{
    /**
     * Create a new logic exception instance.
     *
     * @param string                               $message
     * @param int                                  $code
     * @param \Exception                           $previous
     *
     * @return void
     */
    public function __construct($returnCode = 0, $code = 201998, Exception $previous = null)
    {
        $message = 'Undefined code:'.$returnCode;
        parent::__construct($message, $code, $previous);
    }

}
