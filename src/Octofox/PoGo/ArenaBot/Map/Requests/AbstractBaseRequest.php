<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:24
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests;


use GuzzleHttp\Client;

abstract class AbstractBaseRequest
{
    public const BASE_URI = 'https://bs-pogo.de';

    protected static $client;

    public function __construct()
    {
        self::$client = self::getClient();
    }

    public static function getClient(): Client
    {
        return new Client(
            [
                'base_uri' => self::BASE_URI,
                'headers'  => [
                    'Cookie'           => 'PHPSESSID=vcbugiopouirfdemep5et09dm4',
                    'Origin'           => 'https://bs-pogo.de',
                    'User-Agent'       => 'Instinct Arena Bot @FoXFTW',
                    'Content-Type'     => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Accept'           => 'application/json',
                    'Referer'          => 'https://bs-pogo.de/',
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
            ]
        );
    }
}
