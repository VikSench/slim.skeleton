<?php declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Modules\Auth\Exceptions\UserExistsException;
use App\Modules\Auth\Models\SignupModel;
use PDOException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SignupAction
{
    public function __construct(private readonly SignupModel $signupModel) {}

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $requestData = $request->getParsedBody();

        try {
            $this->signupModel->signup(
                $requestData['email'],
                $requestData['password']
            );
        } catch (PDOException $e) {
            $response->getBody()
                ->write(ResponseHelper::prepareResponse(null, ['critical' => [$e->getMessage()]]));

            return $response
                ->withStatus(HttpHelper::HTTP_STATUS_INTERNAL_SERVER_ERROR)
                ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
        } catch (UserExistsException $e) {
            $response->getBody()
                ->write(ResponseHelper::prepareResponse(null, ['email' => [$e->getMessage()]]));

            return $response
                ->withStatus(HttpHelper::HTTP_STATUS_CONFLICT)
                ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
        }

        $response->getBody()
            ->write(ResponseHelper::prepareResponse(null));

        return $response
            ->withStatus(HttpHelper::HTTP_STATUS_CREATED)
            ->withHeader('Content-Type', $request->getHeaderLine('Accept'));
    }
}