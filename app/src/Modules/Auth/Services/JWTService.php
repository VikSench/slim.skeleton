<?php declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Exceptions\JWTInvalidTypeException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JWTService
{
    public const JWT_TOKEN_TYPE_ACCESS = 'access';
    public const JWT_TOKEN_TYPE_REFRESH = 'refresh';

    public const JWT_TOKEN_TTLS = [
        self::JWT_TOKEN_TYPE_ACCESS => 3600,
        self::JWT_TOKEN_TYPE_REFRESH => 604800,
    ];

    public static function generateToken(array $payload, string $type = self::JWT_TOKEN_TYPE_ACCESS): string
    {
        $time = time();

        $ttl = (int)getenv(match ($type) {
            self::JWT_TOKEN_TYPE_ACCESS => 'JWT_TOKEN_TTL_ACCESS',
            self::JWT_TOKEN_TYPE_REFRESH => 'JWT_TOKEN_TTL_REFRESH',
            default => throw new JWTInvalidTypeException('Invalid token type'),
        }) ?: self::JWT_TOKEN_TTLS[$type];

        $secret = getenv(match ($type) {
            self::JWT_TOKEN_TYPE_ACCESS => 'JWT_TOKEN_SECRET_ACCESS',
            self::JWT_TOKEN_TYPE_REFRESH => 'JWT_TOKEN_SECRET_REFRESH',
            default => throw new JWTInvalidTypeException('Invalid token type'),
        });

        $tokenPayload = [
            ...$payload,
            'iat' => $time,
            'exp' => $time + $ttl,
            'type' => $type,
        ];

        return JWT::encode($tokenPayload, $secret, getenv('JWT_TOKEN_ALGO'));
    }

    public static function validateToken(string $token, string $type = self::JWT_TOKEN_TYPE_ACCESS): stdClass
    {
        $secret = getenv(match ($type) {
            self::JWT_TOKEN_TYPE_ACCESS => 'JWT_TOKEN_SECRET_ACCESS',
            self::JWT_TOKEN_TYPE_REFRESH => 'JWT_TOKEN_SECRET_REFRESH',
            default => throw new JWTInvalidTypeException('Invalid token type'),
        });

        $decoded = JWT::decode($token, new Key($secret, getenv('JWT_TOKEN_ALGO')));

        if (($decoded->type ?? null) !== $type) {
            throw new JWTInvalidTypeException('Mismatched token type');

        }

        return $decoded;
    }
}
