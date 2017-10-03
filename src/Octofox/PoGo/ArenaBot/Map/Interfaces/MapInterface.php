<?php
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:03
 */

namespace Octofox\PoGo\ArenaBot\Map\Interfaces;

use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;

interface MapInterface
{
    public function getArenas(): ArenaCollection;

    public function setConfig(array $config): void;
}