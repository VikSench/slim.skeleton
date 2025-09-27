<?php declare (strict_types=1);

namespace App\Requests\Validators\Rules;

use App\Requests\Validators\Rules\Interfaces\RuleInterface;

class TypeEmailRule implements RuleInterface
{
    public function validate(mixed $value, string|null $param): bool
    {
        return !!filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMessage(string $field, string $source): string
    {
        return sprintf("Field %s in source %s should be email", $field, $source);
    }
}