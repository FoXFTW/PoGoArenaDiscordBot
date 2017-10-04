<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:24
 */

namespace Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap\Requests;

use GuzzleHttp\Client;
use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Map\Interfaces\RequestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractBaseRequest implements RequestInterface, LoggerAwareInterface
{
    /** @var  Client */
    protected $client;
    protected $token;
    protected $config = [];

    /** @var  \Psr\Log\LoggerInterface */
    protected $logger;

    public function __construct(LoggerInterface $logger, array $config)
    {
        $this->logger = $logger;
        $this->config = $config;

        $this->createClient();
        $this->requestNewToken();
    }

    public function requestNewToken(): string
    {
        $i = $this->config['retry_count_on_error'];
        $this->token = null;
        do {
            try {
                $this->token = $this->requestToken(true);
            } catch (InvalidDataException $e) {
                $this->logger->error(
                    "Getting new Token failed, trying again. Pass {$i} out of {$this->config['retry_count_on_error']}"
                );
            }

            if (!is_null($this->token)) {
                return $this->token;
            }
        } while ($i < $this->config['sleep_time_on_error'] && !is_null($this->token));

        $this->logger->error(
            "Could not request a new Token. Sleeping for {$this->config['sleep_time_on_error']} seconds before trying again."
        );
        sleep($this->config['sleep_time_on_error']);

        return $this->requestNewToken();
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger::getInstance();

        return;
    }

    protected function requestToken(?bool $forceNew = false): string
    {
        if ($this->token !== '' && $forceNew === false) {
            return $this->token;
        }

        $content = $this->client->get('')->getBody()->getContents();

        preg_match('/var token\s\=\s\'(.*)\'\;/', $content, $token);

        if (isset($token[1])) {
            $this->token = $token[1];

            return $token[1];
        }

        throw new InvalidDataException('No Token found');
    }

    protected function createClient(?bool $forceNew = false): void
    {
        if (is_null($this->client) || $forceNew === true) {
            $this->client = new Client(
                [
                    'base_uri' => $this->config['map_url'],
                    'headers'  => [
                        'Cookie'           => 'PHPSESSID=vcbugiopouirfdemep5et09dm4',
                        'Origin'           => $this->config['map_url'],
                        'User-Agent'       => 'Instinct Arena Bot @FoXFTW',
                        'Content-Type'     => 'application/x-www-form-urlencoded; charset=UTF-8',
                        'Accept'           => 'application/json',
                        'Referer'          => $this->config['map_url'],
                        'X-Requested-With' => 'XMLHttpRequest',
                    ],
                ]
            );
        }
    }
}
