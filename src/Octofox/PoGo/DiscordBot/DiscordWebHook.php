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
    private const WEBHOOK = 'https://discordapp.com/api/webhooks/';
    private const NAME = DISCORD_BOT_NAME;
    private const AVATAR_URL = DISCORD_BOT_AVATAR;

    private $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => self::WEBHOOK.DISCORD_WEBHOOK_ID,
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
