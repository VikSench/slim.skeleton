<?php declare (strict_types=1);

namespace App\Requests\Validators\Rules;

use App\Requests\Validators\Rules\Interfaces\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(mixed $value, string|null $param): bool
    {
        return !empty($value);
    }

    public function getErrorMessage(string $field, string $source): string
    {
        return sprintf("Field %s in source %s can't be empty", $field, $source);
    }
}