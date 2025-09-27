<?php declare(strict_types=1);

use App\Middlewares\EnforceContentTypeMiddleware;
use App\Middlewares\EnsureContentTypeMiddleware;
use App\Modules\Auth\Actions\SigninAction;
use App\Modules\Auth\Actions\SigninRefreshTokenAction;
use App\Modules\Auth\Actions\SignupAction;
use App\Modules\Auth\Validators\SigninRefreshTokenValidator;
use App\Modules\Auth\Validators\SigninValidator;
use App\Modules\Auth\Validators\SignupValidator;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app) {
    $app->group('/api', function(RouteCollectorProxy $group) {
        $group->group('/v1/auth', function(RouteCollectorProxy $group) {
            $group->post('/signup', SignupAction::class)
                ->add(SignupValidator::class);
            $group->post('/signin', SigninAction::class)
                ->add(SigninValidator::class);
            $group->post('/signin/refresh', SigninRefreshTokenAction::class)
                ->add(SigninRefreshTokenValidator::class);
        });
    })
    ->addMiddleware(new EnsureContentTypeMiddleware('application/json'))
    ->addMiddleware(new EnforceContentTypeMiddleware('application/json'));
};
