<?php declare(strict_types = 1);

return [
    'map'    => [
        // Currently 'rocketmap' and 'gomap' are supported
        'map_type'          => 'example_type',
        'map_url'           => 'https://example.com',
        // 1 Mystic - 2 Valor - 3 Instinct
        // Default: 1
        'monitored_team_id' => 1,
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