<?php declare(strict_types=1);

namespace App\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigService
{
    private readonly Environment $twig;

    public function __construct(string $viewPath)
    {
        $this->twig = new Environment(
            new FilesystemLoader($viewPath),
            ['cache' => true]
        );
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twig->render($template, $data);
    }
}