<?php declare(strict_types=1);

namespace App\Modules\Ping\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PingAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response
            ->getBody()
            ->write(json_encode(['pong' => true]));
        return $response;
    }
}