<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Rewards implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param SimpleItem[] $items
     */
    public function __construct(
        public readonly array $items,
        public readonly int $gold,
    ) {}

    /**
     * @return array{
     *     items: SimpleItem[],
     *     gold: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'items' => $this->items,
            'gold' => $this->gold,
        ];
    }
}
