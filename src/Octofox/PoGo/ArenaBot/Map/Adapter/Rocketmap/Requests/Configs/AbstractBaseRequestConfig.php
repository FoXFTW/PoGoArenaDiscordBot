<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:39
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests\Configs;

use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\AppConfig;
use Octofox\PoGo\ArenaBot\Map\Adapter\Rocketmap\Requests\AbstractBaseRequest;
use Octofox\PoGo\ArenaBot\Map\Interfaces\RequestConfigInterface;
use Octofox\PoGo\ArenaBot\Server\ConsoleLogger;
use Psr\Log\LoggerInterface;


abstract class AbstractBaseRequestConfig implements RequestConfigInterface
{
    protected static $token = '';

    protected $config = [];

    /** @var  LoggerInterface */
    protected $logger;

    public function __construct(?array $config = null)
    {
        if (!is_null($config)) {
            $this->config = array_replace($this->config, $config);
        }
    }

    protected static function requestToken(?bool $force = false): string
    {
        if (self::$token !== '' && $force === false) {
            return self::$token;
        }

        $website = AbstractBaseRequest::getClient()->get('');
        $content = $website->getBody()->getContents();

        preg_match('/var token\s\=\s\'(.*)\'\;/', $content, $token);

        if (isset($token[1])) {
            self::$token = $token[1];

            return $token[1];
        }

        throw new InvalidDataException('No Token found');
    }

    public function getConfig(): array
    {
        $this->config['timestamp'] = time();
        $this->config['token'] = self::requestToken();

        return $this->config;
    }

    public static function requestNewToken(): string
    {
        $i = 0;
        self::$token = null;
        do {
            try {
                self::requestToken(true);
            } catch (InvalidDataException $e) {
                ConsoleLogger::getInstance()->error("Getting new Token failed, trying again. Pass {$i} out of 10");
            }

            if (!is_null(self::$token)) {
                return self::$token;
            }
        } while ($i < 10 && !is_null(self::$token));

        ConsoleLogger::getInstance()->error(
            "Could not request a new Token. Sleeping for ".AppConfig::getInstance(
            )['server.poll_interval']." seconds before trying again."
        );
        sleep(AppConfig::getInstance()['server.poll_interval']);

        return self::requestNewToken();
    }
}
