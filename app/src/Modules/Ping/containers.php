<?php

use Di\Container;
use App\Modules\Ping\Services\PingService;

return function (Container $container) {
    $container->set(PingService::class, function() {
        return new PingService();
    });
};
