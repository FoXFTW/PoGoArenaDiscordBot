<?php
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 14:30
 */

namespace Psr\Log;

interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger);
}