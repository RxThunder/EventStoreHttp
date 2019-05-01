<?php

declare(strict_types=1);

namespace RxThunder\EventStoreHttp;

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Event
{
    public const DEFAULT_EVENT_TYPE = 'event_type';

    /** @var string */
    private $id;

    /** @var string */
    private $type = self::DEFAULT_EVENT_TYPE;

    /**
     * @var array
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversablePropertyTypeHintSpecification
     */
    private $data = [];

    /**
     * @var array
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversablePropertyTypeHintSpecification
     */
    private $metadata = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Event
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Event
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableReturnTypeHintSpecification
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableParameterTypeHintSpecification
     */
    public function setData(array $data): Event
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableReturnTypeHintSpecification
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingTraversableParameterTypeHintSpecification
     */
    public function setMetadata(array $metadata): Event
    {
        $this->metadata = $metadata;

        return $this;
    }
}
