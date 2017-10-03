<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:24
 */

namespace Octofox\PoGo\ArenaBot\Map\Adapter\Rocketmap\Requests;

use GuzzleHttp\Client;
use Octofox\Interfaces\RequestInterface;
use Octofox\PoGo\AppConfig;

abstract class AbstractBaseRequest implements RequestInterface
{
    protected static $client;

    public function __construct()
    {
        self::$client = self::getClient();
    }

    public static function getClient(): Client
    {
        $config = AppConfig::getInstance();

        return new Client(
            [
                'base_uri' => $config->get('map.map_url'),
                'headers'  => [
                    //'Cookie'           => 'PHPSESSID=vcbugiopouirfdemep5et09dm4',
                    'Origin'           => $config->get('map.map_url'),
                    'User-Agent'       => 'Instinct Arena Bot @FoXFTW',
                    'Content-Type'     => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Accept'           => 'application/json',
                    'Referer'          => $config->get('map.map_url'),
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
            ]
        );
    }
}
