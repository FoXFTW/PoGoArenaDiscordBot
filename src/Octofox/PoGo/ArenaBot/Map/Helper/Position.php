<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 18:35
 */

namespace Octofox\PoGo\ArenaBot\Map\Helper;

class Position
{
    private $latitude;
    private $longitude;

    public function __construct(float $latitude,float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function __toString()
    {
        return "{$this->latitude},{$this->longitude}";
    }
}
