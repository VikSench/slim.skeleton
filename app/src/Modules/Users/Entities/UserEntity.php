<?php declare(strict_types=1);

namespace App\Modules\Users\Entities;

class UserEntity
{
    const ROLE_ADMIN = 1;
    const ROLE_USER  = 2;

    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED     = 1;
    const STATUS_BLOCKED       = 2;

    public readonly int $id;
    public readonly string $email;
    public readonly null|string $fullName;
    public readonly null|string $firstName;
    public readonly null|string $lastName;
    public readonly int $status;
    public readonly int $role;

    public function __construct(
        int $id,
        string $email,
        string|null $fullName,
        string|null $firstName,
        string|null $lastName,
        int $status,
        int $role
    ) {
    }
}
