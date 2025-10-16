<?php declare(strict_types=1);

namespace App\Modules\Traders\Actions;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Services\MySQL;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ListAction
{
    public function __construct(
        private readonly Logger $logger,
        private readonly MySQL $mysql
    ) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()
            ->write(ResponseHelper::prepareResponse(['test' => 'reponse']));

        return $response
            ->withStatus(HttpHelper::HTTP_STATUS_OK)
            ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
    }
}