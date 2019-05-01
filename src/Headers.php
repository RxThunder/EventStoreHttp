<?php

declare(strict_types=1);

namespace RxThunder\EventStoreHttp;

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Headers
{
    /**
     * The expected version of the stream (allows optimistic concurrency)
     */
    public const EXPECTED_VERSION = 'ES-ExpectedVersion';

    /**
     * Whether to resolve linkTos in stream
     */
    public const RESOLVE_LINK_TO = 'ES-ResolveLinkTo';

    /**
     * Whether this operation needs to run on the master node
     */
    public const REQUIRES_MASTER = 'ES-RequiresMaster';

    /**
     * Allows a trusted intermediary to handle authentication
     */
    public const TRUSTED_AUTH = 'ES-TrustedAuth';

    /**
     * Instructs the server to do a long poll operation on a stream read
     */
    public const LONG_POLL = 'ES-LongPoll';

    /**
     * Instructs the server to hard delete the stream when deleting as opposed
     * to the default soft delete
     */
    public const HARD_DELETE = 'ES-HardDelete';

    /**
     * Instructs the server the event type associated to a posted body
     */
    public const EVENT_TYPE = 'ES-EventType';

    /**
     * Instructs the server the event id associated to a posted body
     */
    public const EVENT_ID = 'ES-EventId';
}
