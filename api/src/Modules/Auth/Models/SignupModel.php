<?php declare(strict_types=1);

namespace App\Modules\Auth\Models;

use App\Modules\Auth\Exceptions\UserExistsException;
use App\Modules\Users\Entities\UserEntity;
use App\Services\CipherService;
use App\Services\MySQL;
use PDO;
use Psr\Container\ContainerInterface;

class SignupModel
{
    private readonly ContainerInterface $container;
    private readonly PDO $connection;

    public function __construct(
        ContainerInterface $container,
        private readonly CipherService $cipherService,
    )
    {
        $this->container = $container;
        $this->connection = $this->container->get(MySQL::class)->connection();
    }

    public function signup(string $email, string $password): void
    {
        $email =  strtolower($email);
        $emailHash = $this->cipherService->makeStableHash($email);

        $stmt = $this->connection->prepare("SELECT `id` FROM `users` WHERE `email_hash` = :email_hash");
        $stmt->execute([
            'email_hash' => $emailHash,
        ]);

        if ($stmt->fetchColumn()) {
            throw new UserExistsException('Email is already taken');
        }

        $stmt = $this->connection->prepare("
            INSERT INTO `users` (`email`, `email_hash`, `password`, `role`, `status`) VALUES (:email, :email_hash, :password, :role, :status)
        ");

        $stmt->execute([
            'email' => $this->cipherService->encrypt($email),
            'email_hash' => $emailHash,
            'password' => $this->cipherService->makePasswordHash($password),
            'role' => UserEntity::ROLE_USER,
            'status' => UserEntity::STATUS_NOT_CONFIRMED,
        ]);
    }
}