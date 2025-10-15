<?php declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Exceptions\AuthException;
use Psr\Http\Message\ServerRequestInterface;

class TelegramService {
    public function __construct(private readonly ServerRequestInterface $request) {}

    public function validateInitData(string $initData): void
    {
        parse_str($initData, $params);

        $receivedHash = $params['hash'];
        unset($params['hash']);

        uksort($params, function ($a, $b) {
            return strcmp($a, $b);
        });

        $dataCheckString = '';
        foreach ($params as $key => $value) {
            if ($dataCheckString !== '') {
                $dataCheckString .= "\n";
            }
            $dataCheckString .= "{$key}={$value}";
        }

        $secretKey = hash_hmac('sha256', getenv('TELEGRAM_API_TOKEN'), 'WebAppData', true);
        $generatedHash = bin2hex(hash_hmac('sha256', $dataCheckString, $secretKey, true));

        if (!hash_equals($generatedHash, $receivedHash)) {
            throw new AuthException('Invalid initData');
        }

        $this->request->withAttribute('telegramInitData', $params);
    }
}