<?php declare(strict_types = 1);

return [
    'map'    => [
        // Currently only 'rocketmap' is supported
        'map_type'             => 'example_type',
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
            'swLat'         => '52.16591853689746',
            'swLng'         => '10.082879484960586',
            'neLat'         => '52.42355825876934',
            'neLng'         => '10.961785734960586',
            'oSwLat'        => '52.16591853689746',
            'oSwLng'        => '10.082879484960586',
            'oNeLat'        => '52.42355825876934',
            'oNeLng'        => '10.961785734960586',
        ],
        'map_url'              => 'https://example.com',
        // 1 Mystic - 2 Valor - 3 Instinct
        // Default: 1
        'monitored_team_id'    => 1,
        'sleep_time_on_error'  => 120,
        'retry_count_on_error' => 10,
    ],
    'server' => [
        // Poll Interval in seconds
        // Default: 120
        'poll_interval' => 120,
    ],
    'output' => [
        // 'discord' and 'text' are supported
        // Default: text
        'type'    => 'discord',
        'discord' => [
            'webhook_url'        => 'https://discordapp.com/api/webhooks/1234/abcd',
            'webhook_name'       => 'Example Bot',
            'webhook_avatar_url' => 'https://i.imgur.com/It36peS.jpg',
        ],
    ],
    'debug'  => [
        // Log Level on console
        // Default: info
        'log_level'  => 'info',
        // Safe raw poll data in storage dir
        // Default: false
        'safe_polls' => false,
    ],
];