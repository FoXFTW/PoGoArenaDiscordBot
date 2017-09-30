<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:16
 */

namespace Octofox\PoGo\ArenaBot\Map\Entities\Arena;

use Octofox\PoGo\ArenaBot\Map\Helper\NullPosition;
use Octofox\PoGo\ArenaBot\Map\Teams\NullTeam;

class NullArena extends AbstractBaseArena
{
    public function __construct()
    {
        $this->id = '';
        $this->position = new NullPosition();
        $this->name = '';
        $this->team = new NullTeam();

        $this->hash = null;
    }
}
