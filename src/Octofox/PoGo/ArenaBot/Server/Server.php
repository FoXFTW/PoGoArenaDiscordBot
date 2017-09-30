<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:49
 */

namespace Octofox\PoGo\ArenaBot\Server;

use GuzzleHttp\Exception\ClientException;
use Octofox\PoGo\ArenaBot\Diff\Checker\ArenaDiffChecker;
use Octofox\PoGo\DiscordBot\DiscordWebHook;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Parser\ArenaParser;
use Octofox\PoGo\ArenaBot\Map\Requests\Configs\RawDataConfig;
use Octofox\PoGo\ArenaBot\Map\Requests\RawDataRequest;
use Octofox\PoGo\MessageGenerator\ArenaMessageGenerator;

class Server
{
//    public const POLL_INTERVAL = 10;

    private $timeOfLastPoll;
    /** @var  \Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection */
    private $arenaCollection;

    private $arenaParser;
    private $arenaDiffChecker;
    private $arenaDiffMessage;

    private $discordBot;

    public function __construct()
    {
        $this->timeOfLastPoll = time();
        $this->arenaCollection = new ArenaCollection();
        $this->arenaParser = new ArenaParser();
        $this->discordBot = new DiscordWebHook();
    }

    public function run(): void
    {
        while (true) {
            if ($this->shouldPoll()) {
                ConsoleLogger::info('Polling...');
                $this->incrementPollTime();

                $pollData = $this->getParsedPollData();

                if ($this->arenaCollection->getHash() !== '') {
                    if (!$this->arenaCollection->equals($pollData)) {
                        $message = $this->getDiffMessage($pollData);
                        //echo $message;
                        if (!empty($message)) {
                            ConsoleLogger::info("Arenas Changed. Old Hash: {$this->arenaCollection->getHash()} - New Hash: {$pollData->getHash()}");
                            if (!$this->discordBot->sendMessage($message)) {
                                ConsoleLogger::error("Sending Message to Discord Failed!");
                            }
                        }
                    }
                }
                $this->arenaCollection = $pollData;
            }
        }
    }

    private function shouldPoll(): bool
    {
        return time() >= $this->timeOfLastPoll;
    }

    private function incrementPollTime(): void
    {
        $this->timeOfLastPoll = time() + POLL_INTERVAL;
    }

    private function getParsedPollData(): ArenaCollection
    {
        $request = new RawDataRequest(new RawDataConfig());

        try {
            $this->arenaParser->setData($request->request());
            return $this->arenaParser->parse();
        } catch (ClientException $e) {
            ConsoleLogger::error("Polling failed with Message: {$e->getMessage()}");
        }

        return new ArenaCollection();
    }

    private function getDiffMessage(ArenaCollection $pollData): string
    {
        $this->arenaDiffChecker = new ArenaDiffChecker($this->arenaCollection, $pollData);

        $this->arenaDiffMessage = new ArenaMessageGenerator($this->arenaDiffChecker->getDiff());

        return $this->arenaDiffMessage->getMessage();
    }
}
