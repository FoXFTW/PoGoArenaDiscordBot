<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:22
 */

namespace Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap\Requests;

use GuzzleHttp\Exception\ClientException;

class RawDataRequest extends AbstractBaseRequest
{
    private const ROUTE = 'raw_data';

    public function request(): string
    {
        $config = $this->getConfig();

        try {
            $request = $this->client->request(
                'POST',
                self::ROUTE,
                [
                    'form_params' => $config,
                ]
            );
        } catch (ClientException $e) {
            $this->logger->error("Request failed with Message: {$e->getMessage()}");
            $this->requestNewToken();

            return $this->request();
        }

        $content = $request->getBody()->getContents();

        return $content;
    }

    public function getConfig(): array
    {
        $config = $this->config['rocketmap'];
        $config['timestamp'] = time();
        $config['token'] = $this->token;

        return $config;
    }
}
