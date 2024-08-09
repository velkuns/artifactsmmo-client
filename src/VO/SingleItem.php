<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class SingleItem implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly Item $item,
        public readonly null|GEItem $ge,
    ) {}

    /**
     * @return array{
     *     item: Item,
     *     ge: null|GEItem,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'item' => $this->item,
            'ge' => $this->ge,
        ];
    }
}
