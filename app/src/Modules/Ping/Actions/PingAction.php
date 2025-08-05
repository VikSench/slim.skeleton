<?php

namespace App\Modules\Ping\Actions;

use PhpImap\Mailbox;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PingAction
{
    public function imap_utf7_decode_folder($str) {
        return mb_convert_encoding($str, 'UTF-8', 'UTF7-IMAP');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        $mailbox = new Mailbox(
            '{mail.privateemail.com:993/imap/ssl/novalidate-cert}INBOX',
            'test@scrmplat.com',
            '',
            __DIR__,
            'UTF-8',
            true,
            false
        );

        var_dump($mailbox->getMailboxInfo());
        exit;
        $response
            ->getBody()
            ->write(json_encode(['pong' => true]));
        return $response;
    }
}