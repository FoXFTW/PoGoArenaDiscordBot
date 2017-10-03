<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 19:08
 */

namespace Octofox\PoGo\ArenaBot\Map\Parser;

use Octofox\PoGo\ArenaBot\Map\Entities\Arena\Arena;
use Octofox\Exceptions\InvalidDataException;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Helper\Position;
use Octofox\PoGo\ArenaBot\Map\Team\TeamFactory;

class ArenaParser
{
    private $rawData;
    private $gyms;


    public function __construct(?string $data = null)
    {
        $this->rawData = $data;
    }

    public function setData(string $data): void
    {
        $this->rawData = $data;
    }

    public function parse(): ArenaCollection
    {
        $this->prepareRawData();

        $arenaCollection = new ArenaCollection();

        foreach ($this->gyms as $gym) {
            if ($gym['enabled']) {
                $arenaCollection->addArena($this->parseArena($gym));
            }
        }

        return $arenaCollection;
    }

    private function prepareRawData(): void
    {
        $data = json_decode($this->rawData, true);
        if (!isset($data['gyms'])) {
            throw new InvalidDataException('No Gyms found');
        }

        $this->gyms = $data['gyms'];
    }

    private function parseArena(array $rawArenaData): Arena
    {
        $position = new Position($rawArenaData['latitude'], $rawArenaData['longitude']);
        $team = TeamFactory::getTeam($rawArenaData['team_id'] ?? 0);

        return new Arena($rawArenaData['gym_id'], $rawArenaData['name'] ?? 'No Name', intval($rawArenaData['slots_available']), $position, $team);
    }
}
