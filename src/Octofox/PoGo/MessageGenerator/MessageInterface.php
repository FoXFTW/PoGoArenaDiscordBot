<?php
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:43
 */

namespace Octofox\PoGo\MessageGenerator;

interface MessageInterface
{
    public function getMessage(): string;
}