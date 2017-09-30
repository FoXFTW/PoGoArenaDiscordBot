<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 30.09.2017
 * Time: 12:36
 */

namespace Octofox\PoGo;

use Octofox\Exceptions\MissingConfigException;

/**
 * TODO: Cleanup
 *
 * Class Config
 * @package Octofox\PoGo\ArenaBot\Server
 */
class Config
{
    private const DEFAULT_POLL_INTERVAL = 60;
    private const DEFAULT_SAFE_POLLS = false;
    private const DEFAULT_STORAGE_DIR = __DIR__.'/storage';

    public static $parsedConfig = [];

    public static function load(): void
    {
        self::$parsedConfig = parse_ini_file(BASE_PATH.'/config.ini');
        if (self::$parsedConfig === false) {
            throw new MissingConfigException('config.ini is missing!');
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (substr($name, 0, 3) === 'get') {
            $name = str_replace('get', '', $name);
            $name = strtoupper(preg_replace('/\B[A-Z]/', '_$0', $name));

            if (isset(self::$parsedConfig[$name])) {
                return self::$parsedConfig[$name];
            } elseif (defined("self::DEFAULT_{$name}")) {
                return constant("self::DEFAULT_{$name}");
            }

            throw new \BadMethodCallException("Config Key {$name} does not exist");
        } else {
            throw new \BadMethodCallException();
        }
    }
}
