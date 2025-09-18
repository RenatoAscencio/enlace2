<?php

namespace Enlace2\LaravelUrlShortener\Exceptions;

use Exception;

class Enlace2Exception extends Exception
{
    protected mixed $response;

    public function __construct(string $message = '', int $code = 0, mixed $response = null, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse(): mixed
    {
        return $this->response;
    }
}