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
use Octofox\PoGo\Config;

class DiscordWebHook
{
    private const BASE_WEBHOOK_URL = 'https://discordapp.com/api/webhooks/';

    private $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => self::BASE_WEBHOOK_URL.Config::getDiscordWebhookId(),
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
                        'username'   => Config::getDiscordBotName(),
                        'avatar_url' => Config::getDiscordAvatarUrl(),
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
