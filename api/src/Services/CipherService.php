<?php declare(strict_types=1);

namespace App\Services;

class CipherService
{
    private string $cipher = 'aes-256-cbc';

    public function makePasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPasswordHash(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function makeStableHash(string $string): string
    {
        return hash('sha256', mb_strtolower(trim($string)));
    }

    public function encrypt(string $text): string
    {
        $iv = random_bytes(openssl_cipher_iv_length($this->cipher));
        $ciphertext = openssl_encrypt($text, $this->cipher, getenv('CIPHER_SERVICE_SECRET_KEY'), 0, $iv);

        return base64_encode($iv . $ciphertext);
    }

    public function decrypt(string $text): string
    {
        $data = base64_decode($text);
        $ivLength = openssl_cipher_iv_length($this->cipher);
        $iv = substr($data, 0, $ivLength);
        $ciphertext = substr($data, $ivLength);

        return openssl_decrypt($ciphertext, $this->cipher, getenv('CIPHER_SERVICE_SECRET_KEY'), 0, $iv);
    }
}
