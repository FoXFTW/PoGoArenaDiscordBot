<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 15:40
 */

require 'vendor/autoload.php';

try {
    $config = new \Octofox\PoGo\AppConfig(__DIR__.'/config/config.php');
} catch (\Noodlehaus\Exception\FileNotFoundException $e) {
    die('config.php is missing!');
}

$logger = new \Octofox\PoGo\ArenaBot\Server\ConsoleLogger();

$server = new \Octofox\PoGo\ArenaBot\Server\Server($config);
$server->setLogger($logger);
$server->run();
