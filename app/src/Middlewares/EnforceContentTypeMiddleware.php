<?php declare(strict_types=1);

namespace App\Middlewares;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EnforceContentTypeMiddleware implements  MiddlewareInterface
{
    private readonly ResponseInterface $response;

    public function __construct(private readonly string $expectedContentType)
    {
        $this->response = new Response();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!str_starts_with($request->getHeaderLine('Content-Type'), $this->expectedContentType))  {
            $this->response->getBody()
                ->write(ResponseHelper::prepareResponse(
                    null,
                    ['Content-Type' => [
                        sprintf('Unsupported Media Type. Expected: %s, got: %s',
                            $this->expectedContentType,
                            $request->getHeaderLine('Content-Type'))
                        ],
                    ]));

            return $this->response
                ->withStatus(HttpHelper::HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE);
        }

        return $handler->handle($request);
    }
}
