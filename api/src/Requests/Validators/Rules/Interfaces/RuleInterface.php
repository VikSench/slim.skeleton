<?php declare(strict_types=1);

namespace App\Requests\Validators\Rules\Interfaces;

interface RuleInterface
{
    public function validate(mixed $value, string|null $param): bool;
    public function getErrorMessage(string $field, string $source): string;
}