<?php declare(strict_types=1);

namespace App\Middlewares;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EnsureContentTypeMiddleware implements  MiddlewareInterface
{
    private readonly ResponseInterface $response;

    public function __construct(private readonly string $expectedAccept)
    {
        $this->response = new Response();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!str_starts_with($request->getHeaderLine('Accept'), $this->expectedAccept))  {
            $this->response->getBody()
                ->write(ResponseHelper::prepareResponse(
                    null,
                    ['Content-Type' => [
                        sprintf('Unsupported Accept header. Expected media type: %s, got: %s',
                            $this->expectedAccept,
                            $request->getHeaderLine('Accept'))
                        ],
                    ]));

            return $this->response
                ->withStatus(HttpHelper::HTTP_STATUS_NOT_ACCEPTABLE);
        }

        return $handler->handle($request);
    }
}
