<?php

declare(strict_types=1);

namespace RxThunder\EventStoreHttp;

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class EventCollection
{
    /** @var Event[] */
    private $collection = [];

    public function add(Event $event): EventCollection
    {
        array_push($this->collection, $event);

        return $this;
    }

    /**
     * @return Event[]
     */
    public function getCollection(): array
    {
        return $this->collection;
    }

    /**
     * @return array
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableReturnTypeHintSpecification
     */
    public function toArray(): array
    {
        return array_map(
            static function (Event $event) {
                return [
                    'eventId' => $event->getId(),
                    'eventType' => $event->getType(),
                    'data' => $event->getData(),
                    'metadata' => $event->getMetadata(),
                ];
            },
            $this->collection
        );
    }
}
