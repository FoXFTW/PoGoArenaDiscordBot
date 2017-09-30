<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 21:37
 */

namespace Octofox\PoGo\MessageGenerator;

use Octofox\PoGo\ArenaBot\Diff\ArenaDiff;
use Octofox\PoGo\ArenaBot\Map\Entities\Arena\Arena;
use Octofox\PoGo\ArenaBot\Map\Teams\TeamFactory;
use Octofox\PoGo\Config;

class ArenaMessageGenerator implements MessageInterface
{
    private const GOOGLE_MAPS_URL = 'https://www.google.com/maps/?q=';
    private const ARROW_EMOJI = ':arrow_right:';
    private const WON = 'won';
    private const LOST = 'lost';

    private $arenaDiff;
    /** @var \Octofox\PoGo\ArenaBot\Map\Teams\TeamInterface */
    private $teamToMonitor;

    public function __construct(ArenaDiff $diff)
    {
        $this->arenaDiff = $diff;
        $this->teamToMonitor = TeamFactory::getTeam(intval(Config::getTeamIdToMonitor()));
    }

    public function getMessage(): string
    {
        $wonString = "";
        $lostString = "";

        if (count($this->arenaDiff->getWonArenas()) > 0) {
            $wonString = "**Gewonnene Arenen:**\n";
        }

        if (count($this->arenaDiff->getLostArenas()) > 0) {
            $lostString = "**Verlorene Arenen:**\n";
        }

        foreach ($this->arenaDiff->getWonArenas() as $arena) {
            $wonString .= $this->parseArenaToString($arena, self::WON);
        }

        foreach ($this->arenaDiff->getLostArenas() as $arena) {
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
            $string .= "{$arena->getTeam()->getEmoji()}".self::ARROW_EMOJI."{$this->teamToMonitor->getEmoji()})\n";
            $string .= ($arena->getSlotsAvailable() === 0 ? 'Keine' : $arena->getSlotsAvailable())." {$platz} frei\n";
        } else {
            if ((6 - $arena->getSlotsAvailable()) === 1) {
                $platz = "Platz";
            }
            $string .= "{$this->teamToMonitor->getEmoji()}".self::ARROW_EMOJI."{$arena->getTeam()->getEmoji()})\n";
            $string .= (6 - $arena->getSlotsAvailable())." {$platz} besetzt\n";
        }

        $string .= self::GOOGLE_MAPS_URL.$arena->getPosition()."\n\n";

        return $string;
    }
}
