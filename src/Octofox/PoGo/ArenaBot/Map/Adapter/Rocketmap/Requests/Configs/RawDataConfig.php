<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:34
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests\Configs;

class RawDataConfig extends AbstractBaseRequestConfig
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
        'swLat'         => '52.16591853689746',
        'swLng'         => '10.082879484960586',
        'neLat'         => '52.42355825876934',
        'neLng'         => '10.961785734960586',
        'oSwLat'        => '52.16591853689746',
        'oSwLng'        => '10.082879484960586',
        'oNeLat'        => '52.42355825876934',
        'oNeLng'        => '10.961785734960586',
    ];
}
