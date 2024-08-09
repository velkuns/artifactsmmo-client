<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class SkillInfo implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param Drop[] $items
     */
    public function __construct(
        public readonly int $xp,
        public readonly array $items,
    ) {}

    /**
     * @return array{
     *     xp: int,
     *     items: Drop[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'xp' => $this->xp,
            'items' => $this->items,
        ];
    }
}
