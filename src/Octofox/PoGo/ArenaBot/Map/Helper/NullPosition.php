<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:35
 */

namespace Octofox\PoGo\ArenaBot\Map\Helper;

class NullPosition
{
    public function getLatitude(): float
    {
        return 0.0;
    }

    public function getLongitude(): float
    {
        return 0.0;
    }

    public function __toString()
    {
        return '';
    }
}
