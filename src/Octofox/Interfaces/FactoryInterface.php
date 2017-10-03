<?php
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:43
 */

namespace Octofox\Interfaces;


interface FactoryInterface
{
    public static function get($type);
}