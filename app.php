<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 15:40
 */

require 'vendor/autoload.php';
require 'config.php';

$server = new \Octofox\PoGo\ArenaBot\Server\Server();
$server->run();
