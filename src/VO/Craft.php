<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Craft implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|SimpleItem[] $items
     */
    public function __construct(
        public readonly null|string $skill,
        public readonly null|int $level,
        public readonly null|array $items,
        public readonly null|int $quantity,
    ) {}

    /**
     * @return array{
     *     skill: null|string,
     *     level: null|int,
     *     items: null|SimpleItem[],
     *     quantity: null|int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'skill' => $this->skill,
            'level' => $this->level,
            'items' => $this->items,
            'quantity' => $this->quantity,
        ];
    }
}
