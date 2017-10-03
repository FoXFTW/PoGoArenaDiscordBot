<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:30
 */

namespace Octofox\PoGo\ArenaBot\Comparator\Arena;


use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Comparator\Checker\ComparatorInterface;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\Arena;
use Octofox\PoGo\ArenaBot\Map\Team\Instinct;
use Octofox\PoGo\ArenaBot\Map\Team\Mystic;
use Octofox\PoGo\ArenaBot\Map\Team\NoTeam;
use Octofox\PoGo\ArenaBot\Map\Team\Valor;

class ArenaComparator implements ComparatorInterface
{
    private $oldArenas;
    private $newArenas;

    public function __construct(ArenaCollection $oldArenas, ArenaCollection $newArenas)
    {
        $this->oldArenas = $oldArenas;
        $this->newArenas = $newArenas;

        if (count($this->oldArenas) !== count($this->newArenas)) {
            throw new InvalidDataException(
                'Count mismatch! Old: '.count($oldArenas).' New: '.count($newArenas)
            );
        }
    }

    public function compare(): array
    {
        $arenas = [
            Mystic::ID   => [
                'won'  => new ArenaCollection(),
                'lost' => new ArenaCollection(),
            ],
            Valor::ID    => [
                'won'  => new ArenaCollection(),
                'lost' => new ArenaCollection(),
            ],
            Instinct::ID => [
                'won'  => new ArenaCollection(),
                'lost' => new ArenaCollection(),
            ],
            NoTeam::ID   => [
                'won'  => new ArenaCollection(),
                'lost' => new ArenaCollection(),
            ],
        ];

        foreach ($this->oldArenas as $arenaID => $oldArena) {
            if ($oldArena->getTeam()::ID !== $this->newArenas->find($arenaID)->getTeam()::ID) {
                $newArena = $this->newArenas->find($arenaID);

                $arenas[$oldArena->getTeam()::ID]['lost']->add($newArena);
                $arenas[$newArena->getTeam()::ID]['won']->add(
                    new Arena(
                        $oldArena->getID(),
                        $oldArena->getName(),
                        $newArena->getSlotsAvailable(),
                        $oldArena->getPosition(),
                        $oldArena->getTeam()
                    )
                );
            }
        }

        return $arenas;
    }
}
