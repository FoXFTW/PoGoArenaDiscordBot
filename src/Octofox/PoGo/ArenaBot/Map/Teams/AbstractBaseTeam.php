<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:56
 */

namespace Octofox\PoGo\ArenaBot\Map\Teams;

abstract class AbstractBaseTeam implements TeamInterface
{
    protected const MAP_ID = -1;
    protected const NAME = '';
    protected const EMOJI = '';

    public function getID(): int
    {
        return static::MAP_ID;
    }

    public function getName(): string
    {
        return static::NAME;
    }

    public function getEmoji(): string
    {
        return static::EMOJI;
    }

    public function __toString()
    {
        return static::getID().static::getName().static::getEmoji();
    }
}
