<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 04.10.2017
 * Time: 12:04
 */

namespace Octofox\PoGo\ArenaBot\Map;


use Noodlehaus\Exception;
use Octofox\Interfaces\FactoryInterface;
use Octofox\PoGo\AppConfig;
use Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap\Requests\RawDataRequest;
use Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap\RocketMap;
use Octofox\PoGo\ArenaBot\Server\ConsoleLogger;

class MapFactory implements FactoryInterface
{
    public static function get($type)
    {
        switch ($type) {
            case 'rocketmap':
                $request = new RawDataRequest(ConsoleLogger::getInstance(), AppConfig::getInstance()['map']);
                $map = new RocketMap($request);

                return $map;


            case 'gomap':
                throw new Exception('Not Implemented');

            default:
                throw new \InvalidArgumentException("Type {$type} not found in ['rocketmap', 'gomap']!");
        }
    }
}
