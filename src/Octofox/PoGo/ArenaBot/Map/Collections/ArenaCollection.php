<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:07
 */

namespace Octofox\PoGo\ArenaBot\Map\Collections;

use Octofox\Exceptions\InvalidDataException;
use Octofox\Interfaces\CollectionInterface;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\ArenaInterface;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\NullArena;

class ArenaCollection implements CollectionInterface, \Iterator, \Countable
{
    private $arenas = [];
    private $keys = [];
    private $currentPosition = 0;

    private $hash = '';

    public function add($arena): array
    {
        if (!$arena instanceof ArenaInterface) {
            throw new InvalidDataException('Object must implement ArenaInterface');
        }

        $this->arenas[$arena->getID()] = $arena;
        $this->updateHash();

        $this->keys[] = $arena->getID();

        return $this->arenas;
    }

    public function find($id): ArenaInterface
    {
        if (!isset($this->arenas[$id])) {
            return new NullArena();
        }

        return $this->arenas[$id];
    }

    public function all(): array
    {
        return $this->arenas;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function equals(CollectionInterface $collection): bool
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

    /**
     * Return the current element
     * @link  http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        if (isset($this->arenas[$this->keys[$this->currentPosition]])) {
            $currentArenaID = $this->keys[$this->currentPosition];

            return $this->arenas[$currentArenaID];
        }

        return new NullArena();
    }

    /**
     * Move forward to next element
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        if ($this->currentPosition + 1 <= count($this->arenas)) {
            $this->currentPosition++;
        }
    }

    /**
     * Return the key of the current element
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        if (isset($this->keys[$this->currentPosition])) {
            return $this->keys[$this->currentPosition];
        }

        return null;
    }

    /**
     * Checks if current position is valid
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        if (isset($this->keys[$this->currentPosition])) {
            return true;
        }

        return false;
    }

    /**
     * Rewind the Iterator to the first element
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->currentPosition = 0;
    }

    /**
     * Count elements of an object
     * @link  http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->arenas);
    }

    private function updateHash(): void
    {
        $this->hash = sha1(serialize($this->arenas));
    }
}
