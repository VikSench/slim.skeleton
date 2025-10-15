<?php declare(strict_types=1);

use App\Modules\Ping\Actions\PingAction;
use App\Modules\Ping\Actions\ConfigAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function(RouteCollectorProxy $group) {
        $group->get('/ping', PingAction::class);
        $group->get('/config', ConfigAction::class);
    });
};
