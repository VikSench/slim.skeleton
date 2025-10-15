<?php declare(strict_types=1);

use App\Middlewares\AuthMiddleware;
use App\Middlewares\EnforceContentTypeMiddleware;
use App\Middlewares\EnsureContentTypeMiddleware;
use App\Modules\Logger\Actions\TelegramAction;
use Monolog\Logger;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api/v1/logger', function(RouteCollectorProxy $group) {
        $group->post('/telegram', TelegramAction::class);
    })
        ->addMiddleware(new AuthMiddleware(
            $app->getContainer()->get(Logger::class))
        )
        ->addMiddleware(new EnsureContentTypeMiddleware('application/json'))
        ->addMiddleware(new EnforceContentTypeMiddleware('application/json'));
};
