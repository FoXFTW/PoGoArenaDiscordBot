<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:39
 */

namespace Octofox\PoGo\ArenaBot\Map\Teams;

interface TeamInterface
{
    public function getID(): int;

    public function getName(): string;

    public function getEmoji(): string;
}