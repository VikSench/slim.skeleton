<?php declare(strict_types=1);

namespace App\Modules\Logger\Actions;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TelegramAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()
            ->write(ResponseHelper::prepareResponse(['test' => 'reponse']));

        return $response
            ->withStatus(HttpHelper::HTTP_STATUS_CREATED)
            ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
    }
}