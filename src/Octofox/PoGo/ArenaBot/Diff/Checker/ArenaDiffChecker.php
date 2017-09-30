<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:19
 */

namespace Octofox\PoGo\ArenaBot\Diff\Checker;

use Octofox\PoGo\ArenaBot\Diff\ArenaDiff;
use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\Arena;
use Octofox\PoGo\Config;

class ArenaDiffChecker implements CheckerInterface
{
    private $oldArenas;
    private $newArenas;

    public function __construct(ArenaCollection $oldArenas, ArenaCollection $newArenas)
    {
        $this->oldArenas = $oldArenas;
        $this->newArenas = $newArenas;

        if (count($oldArenas) !== count($newArenas)) {
            throw new InvalidDataException(
                'Count mismatch! Old: '.count($oldArenas).' New: '.count($newArenas)
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
            if ($oldArena->getTeam()->getID() !== $this->newArenas->find($arenaID)->getTeam()->getID()) {
                $newArena = $this->newArenas->find($arenaID);

                if ($oldArena->getTeam()->getID() === intval(Config::getTeamIdToMonitor())) {
                    $lostArenas->addArena($newArena);
                } elseif ($newArena->getTeam()->getID() === intval(Config::getTeamIdToMonitor())) {
                    $wonArena = new Arena(
                        $oldArena->getID(),
                        $oldArena->getName(),
                        $newArena->getSlotsAvailable(),
                        $oldArena->getPosition(),
                        $oldArena->getTeam()
                    );
                    $wonArenas->addArena($wonArena);
                }
            }
        }

        return new ArenaDiff($lostArenas, $wonArenas);
    }
}
