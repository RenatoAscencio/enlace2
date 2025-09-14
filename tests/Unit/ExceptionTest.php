<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Exceptions\Enlace2Exception;
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;

class ExceptionTest extends TestCase
{
    public function test_enlace2_exception_can_be_thrown()
    {
        $this->expectException(Enlace2Exception::class);

        throw new Enlace2Exception('Test exception');
    }

    public function test_api_exception_extends_enlace2_exception()
    {
        $exception = new ApiException('API Error');

        $this->assertInstanceOf(Enlace2Exception::class, $exception);
        $this->assertEquals('API Error', $exception->getMessage());
    }

    public function test_rate_limit_exception_extends_enlace2_exception()
    {
        $exception = new RateLimitException('Rate limit exceeded');

        $this->assertInstanceOf(Enlace2Exception::class, $exception);
        $this->assertEquals('Rate limit exceeded', $exception->getMessage());
    }

    public function test_enlace2_exception_stores_response()
    {
        $response = ['error' => 'Invalid API key'];
        $exception = new Enlace2Exception('Test', 401, $response);

        $this->assertEquals($response, $exception->getResponse());
        $this->assertEquals(401, $exception->getCode());
    }
}