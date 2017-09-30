<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 22:22
 */

namespace Octofox\PoGo\ArenaBot\Server;


class ConsoleLogger
{
    public static function __callStatic($name, $arguments)
    {
        self::log("[".strtoupper($name)."] {$arguments[0]}");
    }

    private static function log($message): void
    {
        echo "[".date("Y-m-d H:i:s")."] {$message}\n";
    }
}
