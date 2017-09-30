<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:19
 */

namespace Octofox\PoGo\ArenaBot\Diff\Checker;

use Octofox\PoGo\ArenaBot\Diff\ArenaDiff;
use Octofox\PoGo\ArenaBot\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;

class ArenaDiffChecker implements CheckerInterface
{
    private $oldArenas;
    private $newArenas;

    public function __construct(ArenaCollection $old, ArenaCollection $new)
    {
        $this->oldArenas = $old->getArenas();
        $this->newArenas = $new->getArenas();

        if (count($old->getArenas()) !== count(($new->getArenas()))) {
            throw new InvalidDataException(
                'Count mismatch! Old: '.count($old->getArenas()).' New: '.count($new->getArenas())
            );
        }
    }

    public function getDiff(): ArenaDiff
    {
        /** Old ID = Instinct */
        $lostArenas = new ArenaCollection();
        /** New ID = Instinct */
        $wonArenas = new ArenaCollection();

        foreach ($this->oldArenas as $arenaID => $oldArena) {
            if ($oldArena->getTeam()->getID() !== $this->newArenas[$arenaID]->getTeam()->getID()/* &&
                $oldArena->getTeam()->getID() > 0 &&
                $this->newArenas[$arenaID]->getTeam()->getID() > 0*/) {

                if ($oldArena->getTeam()->getID() === TEAM_ID_TO_MONITOR) {
                    $lostArenas->addArena($this->newArenas[$arenaID]);
                } elseif ($this->newArenas[$arenaID]->getTeam()->getID() === TEAM_ID_TO_MONITOR) {
                    $wonArenas->addArena($oldArena);
                }
            }
        }

        return new ArenaDiff($lostArenas, $wonArenas);
    }
}
