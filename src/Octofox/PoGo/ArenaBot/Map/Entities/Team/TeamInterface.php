<?php
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:45
 */

namespace Octofox\PoGo\ArenaBot\Map\Team;

interface TeamInterface
{
    public function emoji(): string;
    public function id(): int;
    public function name(): string;
}