<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 14:07
 */

namespace Octofox\PoGo;

use Noodlehaus\Config;
use Octofox\Exceptions\NotInitializedException;
use Octofox\Interfaces\SingletonInterface;

class AppConfig extends Config implements SingletonInterface
{
    /** @var  \Octofox\PoGo\AppConfig */
    private static $instance;

    public function __construct($path)
    {
        parent::__construct($path);
        self::$instance = $this;
    }

    public static function getInstance(): AppConfig
    {
        if (is_null(self::$instance)) {
            throw new NotInitializedException('Config needs to be Initialized first!');
        }

        return self::$instance;
    }

    protected function getDefaults(): array
    {
        return [
            'map'    => [
                'monitored_team_id'    => 1,
                'rocketmap'            => [
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
                ],
                'sleep_time_on_error'  => 120,
                'retry_count_on_error' => 10,
            ],
            'server' => [
                'poll_interval' => 120,
            ],
            'output' => [
                'type' => 'text',
            ],
            'debug'  => [
                'log_level'  => 'info',
                'safe_polls' => false,
            ],
        ];
    }
}
