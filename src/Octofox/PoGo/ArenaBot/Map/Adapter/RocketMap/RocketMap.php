<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 23:32
 */

namespace Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap;

use Octofox\PoGo\ArenaBot\Map\Adapter\RocketMap\Parser\ArenaParser;
use Octofox\PoGo\ArenaBot\Map\Collections\ArenaCollection;
use Octofox\PoGo\ArenaBot\Map\Interfaces\MapInterface;
use Octofox\PoGo\ArenaBot\Map\Interfaces\RequestInterface;

class RocketMap implements MapInterface
{
    /** @var \Octofox\PoGo\ArenaBot\Map\Interfaces\RequestInterface */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function getArenas(): ArenaCollection
    {
        $data = $this->request->request();
        $parser = new ArenaParser($data);

        return $parser->parse();
    }
}
