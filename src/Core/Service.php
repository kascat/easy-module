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
    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @param int $options
     * @return HttpResponseException
     */
    public static function exception(array $data = [], int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY, array $headers = [], $options = 0)
    {
        return new HttpResponseException(response()->json($data, $statusCode, $headers, $options));
    }

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

    /**
     * @param $value
     * @return array|string|string[]|null
     */
    public static function onlyNumbers($value)
    {
        return $value ? preg_replace('/[^0-9]/', '', $value) : $value;
    }

    /**
     * @param $value
     * @return array|string|string[]|null
     */
    public static function formatDateToSave($date)
    {
        if (str_contains($date, '/')) {
            $explodedDate = explode('/', $date);
            return "$explodedDate[2]-$explodedDate[1]-$explodedDate[0]";
        }

        return $date;
    }

    /**
     * @param $value
     * @return array|string|string[]|null
     */
    public static function formatDatetimeToSave($datetime)
    {
        if (str_contains($datetime, '/')) {
            $explodedDatetime = explode(' ', $datetime);

            $explodedDate = explode('/', $explodedDatetime[0]);
            return "$explodedDate[2]-$explodedDate[1]-$explodedDate[0] $explodedDatetime[1]";
        }

        return $datetime;
    }

    /**
     * @param array $data
     * @param array $rules
     * @param bool $setDefault
     * @return array
     */
    public static function prepareData(array &$data, array $rules, bool $setDefault = false)
    {
        foreach (array_keys($rules) as $property) {
            if (isset($data[$property]) || $setDefault) {
                $data[$property] = $rules[$property]($data[$property] ?? null);
            }
        }

        return $data;
    }
}
