<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:39
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests\Configs;


use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Map\Requests\AbstractBaseRequest;

abstract class AbstractBaseConfig implements ConfigInterface
{
    protected static $token = '';

    protected $config = [];

    public function __construct(?array $config = null)
    {
        if (!is_null($config)) {
            $this->config = array_replace($this->config, $config);
        }
    }

    protected function requestToken(): string
    {
        if (self::$token !== '') {
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
        $this->config['token'] = $this->requestToken();

        return $this->config;
    }
}
