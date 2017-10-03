<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:54
 */

namespace Octofox\PoGo\ArenaBot\Map\Team;

use Octofox\Interfaces\FactoryInterface;

class TeamFactory implements FactoryInterface
{
    public static function get($type): TeamInterface
    {
        if (is_string($type)) {
            $type = strtolower($type);
        }

        switch ($type) {
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
                return new NoTeam();
        }
    }
}
