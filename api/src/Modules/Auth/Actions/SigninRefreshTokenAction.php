<?php declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Modules\Auth\Exceptions\JWTInvalidTypeException;
use App\Modules\Auth\Services\JWTService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

class SigninRefreshTokenAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $requestData = $request->getParsedBody();

        try {
            $token = JWTService::validateToken(
                $requestData['refresh_token'],
                JWTService::JWT_TOKEN_TYPE_REFRESH
            );
        } catch (JWTInvalidTypeException | UnexpectedValueException $e) {
            $response->getBody()
                ->write(ResponseHelper::prepareResponse(null, ['refresh_token' => [$e->getMessage()]]));

            return $response
                ->withStatus(HttpHelper::HTTP_STATUS_UNAUTHORIZED)
                ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
        }

        $accessToken = JWTService::generateToken([
            'id'   => $token->id,
            'role' => $token->role,
        ]);

        $refreshToken = JWTService::generateToken([
            'id'   => $token->id,
            'role' => $token->role,
        ], JWTService::JWT_TOKEN_TYPE_REFRESH);

        $response->getBody()
            ->write(ResponseHelper::prepareResponse(compact('accessToken', 'refreshToken')));

        return $response
            ->withStatus(HttpHelper::HTTP_STATUS_OK)
            ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
    }
}