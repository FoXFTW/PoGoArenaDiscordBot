<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:15
 */

namespace Octofox\PoGo\ArenaBot\Map\Entities\Arena;

use Octofox\PoGo\ArenaBot\Map\Helper\Position;
use Octofox\PoGo\ArenaBot\Map\Teams\TeamInterface;

interface ArenaInterface
{
    public function getID(): string;

    public function getName(): string;

    public function getSlotsAvailable(): int;

    public function getPosition(): Position;

    public function getTeam(): TeamInterface;

    public function getHash(): string;
}