<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:39
 */

namespace Octofox\PoGo\ArenaBot\Diff;


use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;

class ArenaDiff
{
    /** @var  \Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection */
    private $lostArenas;

    /** @var  \Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection */
    private $wonArenas;

    public function __construct(ArenaCollection $lostArenas, ArenaCollection $wonArenas)
    {
        $this->lostArenas = $lostArenas;
        $this->wonArenas = $wonArenas;
    }

    public function getLostArenas(): ArenaCollection
    {
        return $this->lostArenas;
    }

    public function getWonArenas(): ArenaCollection
    {
        return $this->wonArenas;
    }
}
