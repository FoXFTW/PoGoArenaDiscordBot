<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:25
 */

namespace Octofox\PoGo\ArenaBot\Map\Entities\Arena;

use Octofox\PoGo\ArenaBot\Map\Helper\Position;
use Octofox\PoGo\ArenaBot\Map\Teams\TeamInterface;

class Arena extends AbstractBaseArena
{
    public function __construct(string $id, string $name, int $slots_available, Position $position, TeamInterface $team)
    {
        $this->id = $id;
        $this->position = $position;
        $this->name = $name;
        $this->slots_available = $slots_available;
        $this->team = $team;

        $args = func_get_args();
        $this->hash = sha1(serialize($args));
    }
}
