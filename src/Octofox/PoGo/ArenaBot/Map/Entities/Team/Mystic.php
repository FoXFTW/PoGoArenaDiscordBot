<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:40
 */

namespace Octofox\PoGo\ArenaBot\Map\Team;

class Mystic implements TeamInterface
{
    public const ID = 1;
    public const NAME = 'Mystic';
    public const EMOJI = ':snowflake:';

    public function emoji(): string
    {
        return static::EMOJI;
    }

    public function id(): int
    {
        return static::ID;
    }

    public function name(): string
    {
        return static::NAME;
    }
}
