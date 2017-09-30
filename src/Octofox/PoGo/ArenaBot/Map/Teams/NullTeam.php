<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:45
 */

namespace Octofox\PoGo\ArenaBot\Map\Teams;

class NullTeam extends AbstractBaseTeam implements TeamInterface
{
    protected const MAP_ID = 0;
    protected const NAME = '';
    protected const EMOJI = ':white_circle:';
}