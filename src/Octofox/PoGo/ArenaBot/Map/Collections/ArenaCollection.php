<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:07
 */

namespace Octofox\PoGo\ArenaBot\Map\Collections;

use Octofox\PoGo\ArenaBot\Map\Entities\Arena\ArenaInterface;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\NullArena;

//@ToDo: Implement Iterable
class ArenaCollection
{
    private $arenas = [];
    private $hash = '';

    public function addArena(ArenaInterface $arena): array
    {
        $this->arenas[$arena->getID()] = $arena;
        $this->updateHash();

        return $this->arenas;
    }

    public function find(string $id): ArenaInterface
    {
        if (!isset($this->arenas[$id])) {
            return new NullArena();
        }

        return $this->arenas[$id];
    }

    public function getArenas(): array
    {
        return $this->arenas;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function equals(ArenaCollection $collection): bool
    {
        return $this->hash === $collection->getHash();
    }

    public function __toString()
    {
        $string = '';

        foreach ($this->arenas as $arena) {
            $string .= $arena."\n";
        }

        return $string;
    }

    private function updateHash(): void
    {
        $this->hash = sha1(serialize($this->arenas));
    }
}
