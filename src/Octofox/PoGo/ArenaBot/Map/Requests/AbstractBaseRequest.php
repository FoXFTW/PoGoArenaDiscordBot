<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:24
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests;


use GuzzleHttp\Client;
use Octofox\PoGo\Config;

abstract class AbstractBaseRequest
{
    protected static $client;

    public function __construct()
    {
        self::$client = self::getClient();
    }

    public static function getClient(): Client
    {
        return new Client(
            [
                'base_uri' => Config::getMapUrl(),
                'headers'  => [
                    'Cookie'           => 'PHPSESSID=vcbugiopouirfdemep5et09dm4',
                    'Origin'           => Config::getMapUrl(),
                    'User-Agent'       => 'Instinct Arena Bot @FoXFTW',
                    'Content-Type'     => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Accept'           => 'application/json',
                    'Referer'          => Config::getMapUrl(),
                    'X-Requested-With' => 'XMLHttpRequest',
                ],
            ]
        );
    }

    protected function safeRequest(string $data): void
    {
        if (Config::getSafePolls()) {
            $handle = fopen(BASE_PATH.Config::getStorageDir().'/raw_dadta-'.date('Y-m-d_His').'.json', 'w+');
            fwrite($handle, $data);
            fclose($handle);
        }
    }
}
