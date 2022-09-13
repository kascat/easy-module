<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
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
     * @param $data
     * @param int $statusCode
     * @param array $headers
     * @param int $options
     * @return mixed
     */
    public function response($data = [], int $statusCode = \Illuminate\Http\Response::HTTP_OK, array $headers = [], $options = 0)
    {
        $method = "responseTo" . Str::ucfirst(request()->route()->getActionMethod());

        if (method_exists($this, $method)) {
            return $this->$method($data, $statusCode, $headers, $options);
        }

        return \response()->json($data, $statusCode, $headers, $options);
    }
}
