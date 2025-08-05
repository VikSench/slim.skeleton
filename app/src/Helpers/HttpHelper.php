<?php declare(strict_types=1);

namespace App\Helpers;

class HttpHelper
{
    public const HTTP_STATUS_OK = 200;
    public const HTTP_STATUS_CREATED = 201;
    public const HTTP_STATUS_ACCEPTED = 202;
    public const HTTP_STATUS_NO_CONTENT = 204;
    public const HTTP_STATUS_BAD_REQUEST = 400;
    public const HTTP_STATUS_UNAUTHORIZED = 401;
    public const HTTP_STATUS_FORBIDDEN = 403;
    public const HTTP_STATUS_NOT_FOUND = 404;
    public const HTTP_STATUS_METHOD_NOT_ALLOWED = 405;
    public const HTTP_STATUS_NOT_ACCEPTABLE = 406;
    public const HTTP_STATUS_CONFLICT = 409;
    public const HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE = 415;
    public const HTTP_STATUS_UNPROCESSABLE_ENTITY = 422;
    public const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_STATUS_NOT_IMPLEMENTED = 501;
    public const HTTP_STATUS_BAD_GATEWAY = 502;
    public const HTTP_STATUS_SERVICE_UNAVAILABLE = 503;

}