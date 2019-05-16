<?php

declare(strict_types=1);

namespace RxThunder\EventStoreHttp;

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Clue\React\Buzz\Browser as ReactBrowser;
use EventLoop\EventLoop;
use React\EventLoop\LoopInterface;
use React\Socket\ConnectorInterface;
use Rx\Observable;
use Rxnet\HttpClient\Browser;

final class Client
{
    /** @var string */
    private $dsn;

    /** @var ReactBrowser */
    private $buzzBrowser;

    /** @var Browser */
    private $http;

    public function __construct(string $dsn, ?LoopInterface $loop = null, ?ConnectorInterface $connector = null)
    {
        $this->dsn = $dsn;

        if (!$loop) {
            $loop = EventLoop::getLoop();
        }

        $this->setBrowser(new ReactBrowser($loop, $connector));
    }

    public function setBrowser(ReactBrowser $buzzBrowser): void
    {
        $this->buzzBrowser = $buzzBrowser;
        $this->http        = new Browser($buzzBrowser);
    }

    public function getBrowser(): ReactBrowser
    {
        return $this->buzzBrowser;
    }

    public function getClient(): Browser
    {
        return $this->http;
    }

    /**
     * Metadata are not available with this method
     */
    public function sendEvent(string $stream, Event $event): Observable
    {
        return $this->http->post(
            $this->getUrl($stream),
            [
                Headers::EVENT_ID => $event->getId(),
                Headers::EVENT_TYPE => $event->getType(),
                'Content-type' => 'application/json',
            ],
            \json_encode($event->getData(), JSON_THROW_ON_ERROR)
        );
    }

    public function sendCollection(string $stream, EventCollection $collection): Observable
    {
        return $this->http->post(
            $this->getUrl($stream),
            ['Content-type' => 'application/vnd.eventstore.events+json'],
            \json_encode($collection->toArray(), JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @param Event|EventCollection $payload
     * @param bool                  $wrap    This option automatically wrap an unique Event into an EventCollection which allows metadata
     */
    public function send(string $stream, $payload, bool $wrap = true): Observable
    {
        if ($payload instanceof EventCollection) {
            return $this->sendCollection($stream, $payload);
        }

        if ($wrap) {
            return $this->sendCollection(
                $stream,
                (new EventCollection())->add($payload)
            );
        }

        return $this->sendEvent($stream, $payload);
    }

    protected function getUrl(string $stream): string
    {
        return $this->dsn . '/streams/' . $stream;
    }
}
