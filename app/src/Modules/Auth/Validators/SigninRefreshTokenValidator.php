<?php declare(strict_types=1);

namespace App\Modules\Auth\Validators;

use App\Requests\Validators\CoreValidator;

class SigninRefreshTokenValidator extends CoreValidator
{
    protected array $rules = [
        CoreValidator::SOURCE_BODY => [
            'refresh_token' => 'required|typeString',
        ],
    ];
}