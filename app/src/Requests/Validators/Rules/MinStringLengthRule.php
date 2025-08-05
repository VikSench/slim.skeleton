<?php declare (strict_types=1);

namespace App\Requests\Validators\Rules;

use App\Exception\Validators\RuleException;
use App\Requests\Validators\Rules\Interfaces\RuleInterface;

class MinStringLengthRule implements RuleInterface
{
    private int $minLength;

    public function validate(mixed $value, string|null $minLength): bool
    {
        $minLength = filter_var($minLength, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);

        if (false === $minLength) {
            throw new RuleException('Min lengths should positive integer');
        }

        $this->minLength = $minLength;

        return is_string($value) && mb_strlen($value) >= $minLength;
    }

    public function getErrorMessage(string $field, string $source): string
    {
        return sprintf(
            "Field %s in source %s must be at least %d characters long",
            $field,
            $source,
            $this->minLength
        );
    }
}