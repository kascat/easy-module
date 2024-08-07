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

use Illuminate\Support\Str;

/**
 * Trait Response
 * @package Kascat\EasyModule\Core
 */
trait Response
{
    /**
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     * @param int $options
     * @return mixed
     */
    public function response(mixed $data = [], int $statusCode = 200, array $headers = [], $options = 0)
    {
        $method = "responseTo" . Str::ucfirst(request()->route()->getActionMethod());

        if (method_exists($this, $method)) {
            return $this->$method($data, $statusCode, $headers, $options);
        }

        return \response()->json($data, $statusCode, $headers, $options);
    }
}
