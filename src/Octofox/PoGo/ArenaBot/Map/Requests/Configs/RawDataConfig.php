<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:34
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests\Configs;

class RawDataConfig extends AbstractBaseConfig
{
    protected $config = [
        'timestamp'     => null,
        'token'         => null,
        'pokemon'       => 'false',
        'lastpokemon'   => 'false',
        'pokestops'     => 'false',
        'lastpokestops' => 'false',
        'luredonly'     => 'false',
        'lastgyms'      => 'false',
        'scanned'       => 'false',
        'lastslocs'     => 'false',
        'spawnpoints'   => 'false',
        'lastspawns'    => 'false',
        'gyms'          => 'true',
        'swLat'         => '52.2402196889693',
        'swLng'         => '10.43902453906253',
        'neLat'         => '52.28576461600092',
        'neLng'         => '10.60381946093753',
    ];


}
