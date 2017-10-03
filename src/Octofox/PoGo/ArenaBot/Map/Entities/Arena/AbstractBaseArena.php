<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:18
 */

namespace Octofox\PoGo\ArenaBot\Map\Entities\Arena;

use Octofox\PoGo\ArenaBot\Map\Helper\Position;
use Octofox\PoGo\ArenaBot\Map\Team\TeamInterface;

abstract class AbstractBaseArena implements ArenaInterface
{
    protected $id;
    protected $name;
    protected $slots_available;
    protected $hash;

    /** @var  Position */
    protected $position;

    /** @var  TeamInterface */
    protected $team;

    public function getID(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlotsAvailable(): int
    {
        return $this->slots_available;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getTeam(): TeamInterface
    {
        return $this->team;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function __toString()
    {
        return "{$this->getName()} ({$this->getTeam()->getName()})\n";
    }
}
