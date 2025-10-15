<?php declare(strict_types=1);

namespace App\Bootstrap;

use App\Services\MySQL;
use DI\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\Factory\AppFactory as SlimAppFactory;

class AppFactory
{
    public static function create(): \Slim\App
    {
        $container = new Container();

        $container->set(MySQL::class, fn () => new MySQL(
            getenv('MYSQL_HOST'),
            getenv('MYSQL_DATABASE'),
            getenv('MYSQL_CHARSET'),
            getenv('MYSQL_USER'),
            getenv('MYSQL_PASSWORD')
        ));
        $container->set(Logger::class, fn () => (new Logger('info'))->pushHandler(new StreamHandler(__DIR__ . '/../logs/info.log')));

        SlimAppFactory::setContainer($container);

        $app = SlimAppFactory::create();

        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        $modulesPath = sprintf("%s/../Modules", __DIR__);

        $modules = array_filter(scandir($modulesPath), fn ($module) => !in_array($module, ['.', '..']));

        foreach ($modules as $module) {
            $moduleRoutePath = sprintf("%s/%s/routes.php", $modulesPath, $module);
            if (!is_file($moduleRoutePath)) {
                continue;
            }

            $appModule = require_once $moduleRoutePath;
            if (!is_callable($appModule)) {
                continue;
            }

            $appModule($app);

            $moduleContainersPath = sprintf("%s/%s/containers.php", $modulesPath, $module);
            if (!is_file($moduleContainersPath)) {
                continue;
            }

            $appModuleContainer = require_once $moduleContainersPath;
            if (!is_callable($appModuleContainer)) {
                continue;
            }
            $appModuleContainer($container);
        }

        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            return $response->withHeader('Content-Type', 'application/json');
        });

        return $app;
    }
}
