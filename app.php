<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 15:40
 */

require 'vendor/autoload.php';
require 'config.php';

$server = new \Octofox\PoGoArenaBot\Server\Server();
$server->run();

/**
define('NO_TEAM', 0);
define('TEAM_MYSTIC', 1);
define('TEAM_VALOR', 2);
define('TEAM_INSTINCT', 3);

function getRawData(): string
{
    $guzzle = new GuzzleHttp\Client(
        [
            'base_uri' => 'https://bs-pogo.de',
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

    try {
        $response = $guzzle->request(
            'POST',
            'raw_data',
            [
                'form_params' => [
                    'timestamp'     => time(),
                    'pokemon'       => 'false',
                    'lastpokemon'   => 'false',
                    'pokestops'     => 'false',
                    'lastpokestops' => 'false',
                    'luredonly'     => 'false',
                    'lastgyms'      => 'true',
                    'scanned'       => 'false',
                    'lastslocs'     => 'false',
                    'spawnpoints'   => 'false',
                    'lastspawns'    => 'false',
                    'gyms'          => 'true',
                    'swLat'         => '52.2402196889693',
                    'swLng'         => '10.43902453906253',
                    'neLat'         => '52.28576461600092',
                    'neLng'         => '10.60381946093753',
                    'token'         => 'ZDKx9vn/4hhz6FGhtB/+UhFxR5DRLHlp5MtOBkIckzQ=',
                ],
            ]
        );
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        die($e->getMessage());
    }

    $data = $response->getBody()->getContents();

    return $data;
}

function getArenaData(): array
{
    $data = getRawData();

    $data = json_decode($data, true);

    $gyms = [
        NO_TEAM => 0,
        TEAM_MYSTIC => 0,
        TEAM_VALOR => 0,
        TEAM_INSTINCT => 0,
    ];

    foreach ($data['gyms'] as $gym) {
        if (isset($gym['team_id'])) {
            $gyms[$gym['team_id']]++;
        }
    }

    return $gyms;
}

function arenaDataToString(): string
{
    $data = getArenaData();

    return "Anzahl Mystic Arenen: ".$data[TEAM_MYSTIC]."\n"."Anzahl Valor Arenen: ".$data[TEAM_VALOR]."\n"."Anzahl Instinct Arenen: ".$data[TEAM_INSTINCT]."\n\nOhne Team: ".$data[NO_TEAM];
}

$request = new \Octofox\PoGoArenaBot\Map\Requests\RawDataRequest();
die($request->request());

$lastMD5 = null;

$postTime = time() + 10;

while (true) {
    $lastMD5 = md5(getRawData());

    if (time() >= $postTime) {
        $postTime = time() + 15;
        $webhook = new \GuzzleHttp\Client(
            [
                'base_uri' => 'https://discordapp.com/api/webhooks/363324837273403396/OZaBIWdLeVvE3MTmFnpGOAA0IaQMJRzrxUUKF0dK_0wB5cBjRfD3jr7ipQ96igDZMXyi',
            ]
        );

        $webhook->post(
            '',
            [
                'json' => [
                    'content'  => arenaDataToString(),
                    'username' => 'Instinct Arena Bot',
                    'avatar_url' => 'https://i.imgur.com/It36peS.jpg',
                ],
            ]
        );
    }
}
**/