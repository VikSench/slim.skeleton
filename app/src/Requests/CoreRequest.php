<?php declare(strict_types=1);

namespace App\Requests;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\Route;
use Slim\Routing\RouteContext;

abstract class CoreRequest
{
    public function __construct(protected readonly ContainerInterface $container) {}

    protected function getRoute(ServerRequestInterface $request): Route
    {
        return (RouteContext::fromRequest($request))->getRoute();
    }
}