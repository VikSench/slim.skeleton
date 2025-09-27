<?php

namespace App\Modules\Ping\Actions;

use App\Modules\Ping\Services\PingService;
use App\Services\MySQL;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ConfigAction
{
    private readonly MySQL $connection;
    private readonly PingService $ping;

    public function __construct(
        MySQL $connection,
        PingService $ping
    )
    {
        $this->connection = $connection;
        $this->ping = $ping;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response
            ->getBody()
            ->write(json_encode([
                '$_SERVER' => $_SERVER,
                '$_ENV' => $_ENV
            ]));
        return $response;
    }
}