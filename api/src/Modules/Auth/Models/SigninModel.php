<?php declare(strict_types=1);

namespace App\Modules\Auth\Models;

use App\Modules\Auth\Exceptions\UserNotFoundException;
use App\Modules\Users\Entities\UserEntity;
use App\Services\CipherService;
use App\Services\MySQL;
use PDO;
use Psr\Container\ContainerInterface;

class SigninModel
{
    private readonly PDO $connection;

    public function __construct(
        private readonly ContainerInterface $container,
        private readonly CipherService $cipherService,
    )
    {
        $this->connection = $this->container->get(MySQL::class)->connection();
    }

    // public function findUser(string $email): UserEntity
    public function findUser(string $email): void
    {
        $stmt = $this->connection->prepare("
            SELECT `id`, `email`, `password`, `full_name`, `status`, `role` FROM `users` WHERE `email_hash` = :email LIMIT 1
        ");
        $stmt->execute([
            'email' => $this->cipherService->makeStableHash($email),
        ]);

        $user = $stmt->fetch();
        if (false === $user) {
            throw new UserNotFoundException('User not found');
        }

        // return new UserEntity();
    }

    // public function findAndValidateUser(string $email, string $password): UserEntity
    public function findAndValidateUser(string $email, string $password): void
    {
        // $user = $this->findUser($email);

        // if (false === $this->cipherService->verifyPasswordHash($password, $user->password)) {
        //     throw new UserNotFoundException('User not found');
        // }

        // return $user;
    }
}