<?php

namespace Kascat\EasyModule\Core;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 * Class Service
 * @package Kascat\EasyModule\Core
 */
class Service
{
    use Utils;

    /**
     * @param $response
     * @param int $statusCode
     * @return array
     */
    protected static function buildReturn($response = [], int $statusCode = Response::HTTP_OK): array
    {
        return [
            'response' => $response,
            'status' => $statusCode
        ];
    }
}
