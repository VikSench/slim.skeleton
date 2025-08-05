<?php

use App\Modules\Ping\Actions\PingAction;
use App\Modules\Ping\Actions\ConfigAction;
use Slim\App;

return function (App $app) {
    $app->get('/ping', PingAction::class);
    $app->get('/config', ConfigAction::class);
};
