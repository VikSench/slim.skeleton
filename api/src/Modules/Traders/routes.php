<?php declare(strict_types=1);

// use App\Middlewares\AuthMiddleware;
use App\Middlewares\EnforceContentTypeMiddleware;
use App\Middlewares\EnsureContentTypeMiddleware;
use App\Modules\Traders\Actions\ListAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function(RouteCollectorProxy $group) {
        $group->group('/v1', function(RouteCollectorProxy $group) {
            $group->get('/traders', ListAction::class);
        });
    })
        // ->addMiddleware(new AuthMiddleware)
        ->addMiddleware(new EnsureContentTypeMiddleware('application/json'))
        ->addMiddleware(new EnforceContentTypeMiddleware('application/json'));
};
