<?php

namespace App\Services;

use PDO;

class MySQL
{
    private readonly PDO $connection;

    public function __construct(
        string $host,
        string $database,
        string $charset,
        string $user,
        string $password,
        array $options = []
    )
    {
        $dns = sprintf("mysql:host=%s;dbname=%s;charset=%s",
            $host,
            $database,
            $charset
        );

        $this->connection = new PDO(
            $dns,
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ...$options,
            ]
        );
    }

    public function connection(): PDO
    {
        return $this->connection;
    }
}