<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:49
 */

namespace Octofox\PoGo\ArenaBot\Server;

use Octofox\PoGo\AppConfig;
use Octofox\PoGo\ArenaBot\Comparator\Arena\ArenaComparator;
use Octofox\PoGo\ArenaBot\Map\Interfaces\MapInterface;
use Octofox\PoGo\ArenaBot\Map\Team\TeamFactory;
use Octofox\PoGo\Message\Gateways\MessageGatewayInterface;
use Octofox\PoGo\Message\Generators\ArenasChanged\ArenaMessageGenerator;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class Server implements LoggerAwareInterface
{
    /** @var  \Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection */
    private $oldArenas;

    /** @var  LoggerInterface */
    private $logger;

    /** @var  AppConfig */
    private $config;

    /** @var  \Octofox\PoGo\ArenaBot\Map\Interfaces\MapInterface */
    private $map;

    /** @var  \Octofox\PoGo\Message\Gateways\MessageGatewayInterface */
    private $messageGateway;

    public function __construct(AppConfig $config)
    {
        $this->config = $config;
    }

    public function run(): void
    {
        while (true) {
            if (is_null($this->oldArenas)) {
                $this->logger->info('First Poll!');
                $this->oldArenas = $this->map->getArenas();
            } else {
                $this->logger->info('Polling...');

                $arenas = $this->map->getArenas();

                if (!$arenas->equals($this->oldArenas)) {
                    $this->logger->info('Arenas Changed.');
                    $this->logger->debug("Old Hash: {$this->oldArenas->getHash()} - New Hash: {$arenas->getHash()}");

                    $comparator = new ArenaComparator($this->oldArenas, $arenas);
                    $comparedArenas = $comparator->compare();

                    $messageGenerator = new ArenaMessageGenerator(
                        $comparedArenas[$this->config['map.monitored_team_id']]['lost'],
                        $comparedArenas[$this->config['map.monitored_team_id']]['won'],
                        TeamFactory::get($this->config['map.monitored_team_id'])
                    );

                    if (!$this->messageGateway->send($messageGenerator->getMessage())) {
                        $this->logger->error('Sending message through gateway failed!');
                    }
                }
            }

            $this->logger->debug("Sleeping for {$this->config['server.poll_interval']} seconds.");
            sleep($this->config['server.poll_interval']);
        }
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger::getInstance();

        return;
    }

    public function setMap(MapInterface $map)
    {
        $this->map = $map;
    }

    public function setMessageGateway(MessageGatewayInterface $gateway)
    {
        $this->messageGateway = $gateway;
    }
}
