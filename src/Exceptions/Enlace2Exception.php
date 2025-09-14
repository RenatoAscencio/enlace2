<?php

namespace Enlace2\LaravelUrlShortener\Exceptions;

use Exception;

class Enlace2Exception extends Exception
{
    protected $response;

    public function __construct($message = '', $code = 0, $response = null, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}