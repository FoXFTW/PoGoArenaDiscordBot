<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 22:15
 */

namespace Octofox\PoGo\DiscordBot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class DiscordWebHook
{
    private const WEBHOOK = 'https://discordapp.com/api/webhooks/363324837273403396/OZaBIWdLeVvE3MTmFnpGOAA0IaQMJRzrxUUKF0dK_0wB5cBjRfD3jr7ipQ96igDZMXyi';
    private const NAME = 'Instinct Arena Bot';
    private const AVATAR_URL = 'https://i.imgur.com/It36peS.jpg';

    private $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => self::WEBHOOK,
            ]
        );
    }

    public function sendMessage(string $message): bool
    {
        try {
            $this->client->post(
                '',
                [
                    'json' => [
                        'content'    => $message,
                        'username'   => self::NAME,
                        'avatar_url' => self::AVATAR_URL,
                    ],
                ]
            );

            return true;
        } catch (ClientException | RequestException | ConnectException | BadResponseException $e) {
            echo "ERROR: {$e->getMessage()}";

            return false;
        }
    }
}
