<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:45
 */

namespace Octofox\PoGo\ArenaBot\Map\Team;

class NoTeam implements TeamInterface
{
    public const ID = 0;
    public const NAME = '';
    public const EMOJI = ':white_circle:';

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