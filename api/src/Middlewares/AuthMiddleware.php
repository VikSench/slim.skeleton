<?php declare(strict_types=1);

namespace App\Middlewares;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Modules\Auth\Services\JWTService;
use DomainException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements  MiddlewareInterface
{
    private readonly ResponseInterface $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $authToken = $request->getHeaderLine('Authorization');
        [$tokenType, $token] = array_pad(explode(' ', $authToken, 2), 2, null);

        try { JWTService::validateToken($token); }
        catch (DomainException $e) {

            $this->response->getBody()
                ->write(ResponseHelper::prepareResponse(null));

            return $this->response
                ->withStatus(HttpHelper::HTTP_STATUS_UNAUTHORIZED)
                ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
        }

        return $handler->handle($request);
    }
}
