<?php
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:11
 */

namespace Octofox\PoGo\Message\Gateways;

interface MessageGatewayInterface
{
    public function send(string $message): bool;
}