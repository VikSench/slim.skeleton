<?php declare(strict_types=1);

namespace App\Requests\Validators;

use App\Helpers\HttpHelper;
use App\Helpers\ResponseHelper;
use App\Middlewares\CoreMiddleware;
use Nyholm\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class CoreValidator extends CoreMiddleware
{
    private readonly ResponseInterface $response;

    protected array $rules = [];

    public const SOURCE_BODY  = 'body';
    public const SOURCE_QUERY = 'query';
    public const SOURCE_URL   = 'url';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->response = new Response();
    }

    final public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $errors = $this->validate($request);

        if (!empty($errors)) {
            $this->response->getBody()
                ->write(ResponseHelper::prepareResponse($errors));

            return $this->response
                ->withStatus(HttpHelper::HTTP_STATUS_UNPROCESSABLE_ENTITY)
                ->withHeader('Content-Type', $request->getAttribute('headerAccept'));
        }

        return $handler->handle($request);
    }

    private function validate(ServerRequestInterface $request): array
    {
        $errors = [];
        $sources = array_keys($this->rules);

        foreach ($sources as $source) {
            $sourceData = $this->getSource($source, $request);
            $sourceData = array_map('trim', $sourceData);

            foreach ($this->rules[$source] as $field => $rules) {
                $rules = explode('|', $rules);

                foreach ($rules as $rule) {
                    [$ruleType, $param] = array_pad(explode(':', $rule, 2), 2, null);

                    $classRule = sprintf("App\Requests\Validators\Rules\%sRule", ucfirst($ruleType));

                    /** @var \App\Requests\Validators\Rules\Interfaces\RuleInterface $ruleInstance */
                    $ruleInstance = new $classRule();

                    if (!$ruleInstance->validate($sourceData[$field] ?? null, $param)) {
                        $errors[$field][] = $ruleInstance->getErrorMessage($field, $source);
                    }

                }
            }
        }

        return $errors;
    }

    private function getSource(string $source, ServerRequestInterface $request): array
    {
        return match($source) {
            self::SOURCE_BODY  => $request->getParsedBody() ?? [],
            self::SOURCE_QUERY => $request->getQueryParams() ?? [],
            self:: SOURCE_URL  => $this->getRoute($request)->getArguments() ?? [],
            default            => [],
        };
    }
}