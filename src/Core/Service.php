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

/**
 * Class Service
 * @package Kascat\EasyModule\Core
 */
class Service
{
    use Utils;

    const RESPONSE = 'response';
    const HTTP_STATUS = 'status';

    const WITH_RELATIONSHIP = 'with';
    const PER_PAGE = 'perPage';

    /**
     * @param mixed $response
     * @param int $httpStatus
     * @return array
     */
    protected static function buildReturn(mixed $response = [], int $httpStatus = 200): array
    {
        return [
            self::RESPONSE => $response,
            self::HTTP_STATUS => $httpStatus,
        ];
    }
}
