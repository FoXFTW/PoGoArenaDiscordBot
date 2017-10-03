<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:22
 */

namespace Octofox\PoGo\ArenaBot\Map\Adapter\Rocketmap\Requests;

use Octofox\PoGo\ArenaBot\Map\Interfaces\RequestConfigInterface;

class RawDataRequest extends AbstractBaseRequest
{
    private const ROUTE = 'raw_data';

    private $config;

    public function __construct(RequestConfigInterface $config)
    {
        $this->config = $config;

        parent::__construct();
    }

    public function request(): string
    {
        $config = $this->config->getConfig();

        $request = static::$client->request(
            'POST',
            self::ROUTE,
            [
                'form_params' => $config,
            ]
        );

        $content = $request->getBody()->getContents();

        return $content;
    }
}
