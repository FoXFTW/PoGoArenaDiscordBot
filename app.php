<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 15:40
 */

require 'vendor/autoload.php';

define('BASE_PATH', __DIR__);
\Octofox\PoGo\Config::load();

$server = new \Octofox\PoGo\ArenaBot\Server\Server();
$server->run();
