<?php declare(strict_types=1);

namespace App\Helpers;

class ResponseHelper
{
    public static function prepareResponse(array|null $data, array|null $errors = null): string
    {
        $response = is_null($errors)
            ? ['data' => $data]
            : ['errors' => $errors];

        return json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}