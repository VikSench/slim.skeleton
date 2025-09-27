<?php declare(strict_types=1);

namespace App\Modules\Auth\Validators;

use App\Requests\Validators\CoreValidator;

class SigninValidator extends CoreValidator
{
    protected array $rules = [
        CoreValidator::SOURCE_BODY => [
            'email' => 'required|typeEmail',
            'password' => 'required|minStringLength:6',
        ],
    ];
}