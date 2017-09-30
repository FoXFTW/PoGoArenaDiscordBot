<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 29.09.2017
 * Time: 20:22
 */

namespace Octofox\PoGo\ArenaBot\Map\Requests;

use Octofox\PoGo\ArenaBot\Map\Requests\Configs\ConfigInterface;

class RawDataRequest extends AbstractBaseRequest implements RequestInterface
{
    private const ROUTE = 'raw_data';

    private $config;

    public function __construct(ConfigInterface $config)
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
        $this->safeRequest($content);

        return $content;
    }
}
