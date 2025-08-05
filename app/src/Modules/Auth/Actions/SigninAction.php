<?php declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Modules\Auth\Exceptions\UserNotFoundException;
use App\Modules\Auth\Models\SigninModel;
use App\Modules\Auth\Services\JWTService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SigninAction
{
    public function __construct(private readonly SigninModel $signinModel) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $requestData = $request->getParsedBody();
        ['email' => $email, 'password' => $password] = $requestData;

        try {
            $user = $this->signinModel->findAndValidateUser(
                $email,
                $password
            );
        } catch (UserNotFoundException $e) {
            $response->getBody()
                ->write(ResponseHelper::prepareResponse(null, ['errors' => ['email' => [$e->getMessage()]]]));

            return $response
                ->withStatus(HttpHelper::HTTP_STATUS_UNAUTHORIZED)
                ->withHeader('Content-Type', $request->getAttribute('headerAccept'));
        }

        $accessToken = JWTService::generateToken([
            'id' => $user->id,
            'role' => $user->role,
        ]);

        $refreshToken = JWTService::generateToken([
            'id' => $user->id,
            'role' => $user->role,
        ], JWTService::JWT_TOKEN_TYPE_REFRESH);

        $response->getBody()
            ->write(ResponseHelper::prepareResponse(compact('accessToken', 'refreshToken')));

        return $response
            ->withStatus(HttpHelper::HTTP_STATUS_OK)
            ->withHeader('Content-Type', $request->getAttribute('headerAccept'));
    }
}