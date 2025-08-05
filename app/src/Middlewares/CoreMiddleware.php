<?php declare(strict_types=1);

namespace App\Middlewares;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Routing\Route;
use Slim\Routing\RouteContext;

abstract class CoreMiddleware implements MiddlewareInterface
{
    public function __construct(protected readonly ContainerInterface $container) {}

    protected function getRoute(ServerRequestInterface $request): Route
    {
        return (RouteContext::fromRequest($request))->getRoute();
    }
}