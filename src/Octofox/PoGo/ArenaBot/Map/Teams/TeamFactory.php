<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:54
 */

namespace Octofox\PoGo\ArenaBot\Map\Teams;

class TeamFactory
{
    public static function getTeam($id): TeamInterface
    {
        if (is_string($id)) {
            $id = strtolower($id);
        }

        switch ($id) {
            case 1:
            case 'mystic':
                return new Mystic();

            case 2:
            case 'valor':
                return new Valor();

            case 3:
            case 'instinct':
                return new Instinct();

            default:
                return new NullTeam();
        }
    }
}
