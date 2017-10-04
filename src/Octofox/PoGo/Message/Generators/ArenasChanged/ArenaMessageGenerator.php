<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:37
 */

namespace Octofox\PoGo\Message\Generators\ArenasChanged;

use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\Arena;
use Octofox\PoGo\ArenaBot\Map\Team\TeamInterface;
use Octofox\PoGo\Message\Generators\MessageGeneratorInterface;

class ArenaMessageGenerator implements MessageGeneratorInterface
{
    private const GOOGLE_MAPS_URL = 'https://www.google.com/maps/?q=';
    private const ARROW_EMOJI = ':arrow_right:';
    private const WON = 'won';
    private const LOST = 'lost';

    /** @var  ArenaCollection */
    private $lostArenas;
    /** @var  ArenaCollection */
    private $wonArenas;

    /** @var \Octofox\PoGo\ArenaBot\Map\Team\TeamInterface */
    private $teamToMonitor;

    public function __construct(ArenaCollection $lostArenas, ArenaCollection $wonArenas, TeamInterface $teamToMonitor)
    {
        $this->lostArenas = $lostArenas;
        $this->wonArenas = $wonArenas;
        $this->teamToMonitor = $teamToMonitor;
    }

    public function getMessage(): string
    {
        $wonString = "";
        $lostString = "";

        if (count($this->wonArenas) > 0) {
            $wonString = "**Gewonnene Arenen:**\n";
        }

        if (count($this->lostArenas) > 0) {
            $lostString = "**Verlorene Arenen:**\n";
        }

        foreach ($this->wonArenas as $arena) {
            $wonString .= $this->parseArenaToString($arena, self::WON);
        }

        foreach ($this->lostArenas as $arena) {
            $lostString .= $this->parseArenaToString($arena, self::LOST);
        }

        $string = $wonString;
        if ($lostString !== "") {
            $string .= "\n{$lostString}";
        }

        return trim($string);
    }

    private function parseArenaToString(Arena $arena, string $type): string
    {
        $platz = "Plätze";

        $string = "{$arena->getName()} (";

        if ($type === self::WON) {
            if ($arena->getSlotsAvailable() === 1) {
                $platz = "Platz";
            }
            $string .= "{$arena->getTeam()->emoji()}".self::ARROW_EMOJI."{$this->teamToMonitor->emoji()})\n";
            $string .= ($arena->getSlotsAvailable() === 0 ? 'Keine' : $arena->getSlotsAvailable())." {$platz} frei\n";
        } else {
            if ((6 - $arena->getSlotsAvailable()) === 1) {
                $platz = "Platz";
            }
            $string .= "{$this->teamToMonitor->emoji()}".self::ARROW_EMOJI."{$arena->getTeam()->emoji()})\n";
            $string .= (6 - $arena->getSlotsAvailable())." {$platz} besetzt\n";
        }

        $string .= self::GOOGLE_MAPS_URL.$arena->getPosition()."\n";

        return $string;
    }
}
