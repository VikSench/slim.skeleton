<?php declare(strict_types=1);

namespace App\Middlewares;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Modules\Auth\Exceptions\AuthException;
use App\Modules\Auth\Services\JWTService;
use App\Modules\Auth\Services\TelegramService;
use Monolog\Logger;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private readonly Response $response;

    public function __construct(private readonly Logger $logger)
    {
        $this->response = new Response();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $authToken = $request->getHeaderLine('Authorization');
        [$tokenType, $token] = array_pad(explode(' ', $authToken, 2), 2, null);

        try {
            match ($tokenType) {
                'Bearer'   => JWTService::validateToken($token),
                'Telegram' => (new TelegramService($request))->validateInitData($token),
                default    => throw new AuthException('Unsupported auth type'),
            };
        } catch (AuthException $e) {
            $this->response->getBody()
                ->write(ResponseHelper::prepareResponse(null));

            return $this->response
                ->withStatus(HttpHelper::HTTP_STATUS_UNAUTHORIZED)
                ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
        }

        return $handler->handle($request);
    }
}
