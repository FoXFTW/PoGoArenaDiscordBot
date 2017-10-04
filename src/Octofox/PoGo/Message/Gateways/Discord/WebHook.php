<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 22:15
 */

namespace Octofox\PoGo\Message\Gateways\Discord;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Octofox\PoGo\AppConfig;
use Octofox\PoGo\Message\Gateways\MessageGatewayInterface;

class WebHook implements MessageGatewayInterface
{
    private $client;
    private $config;

    public function __construct(AppConfig $config)
    {
        $this->config = $config;

        $this->client = new Client(
            [
                'base_uri' => $config->get('output.discord.webhook_url'),
            ]
        );
    }

    public function send(string $message): bool
    {
        try {
            $this->client->post(
                '',
                [
                    'json' => [
                        'content'    => $message,
                        'username'   => $this->config->get('output.discord.webhook_name'),
                        'avatar_url' => $this->config->get('output.discord.webhook_avatar_url'),
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
