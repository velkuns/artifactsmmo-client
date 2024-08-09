<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class RecyclingItems implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param Drop[] $items
     */
    public function __construct(
        public readonly array $items,
    ) {}

    /**
     * @return array{
     *     items: Drop[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'items' => $this->items,
        ];
    }
}
