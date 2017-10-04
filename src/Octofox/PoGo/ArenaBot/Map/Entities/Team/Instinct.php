<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:46
 */

namespace Octofox\PoGo\ArenaBot\Map\Team;

class Instinct implements TeamInterface
{
    public const ID = 3;
    public const NAME = 'Instinct';
    public const EMOJI = ':zap:';

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