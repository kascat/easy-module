<?php

/**
 * This file is part of the kascat/easy-module library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fabio Dukievicz <fabiojd47@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

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
            'status'   => $statusCode
        ];
    }
}
