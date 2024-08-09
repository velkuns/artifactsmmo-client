<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BlockedHits implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $fire,
        public readonly int $earth,
        public readonly int $water,
        public readonly int $air,
        public readonly int $total,
    ) {}

    /**
     * @return array{
     *     fire: int,
     *     earth: int,
     *     water: int,
     *     air: int,
     *     total: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'fire' => $this->fire,
            'earth' => $this->earth,
            'water' => $this->water,
            'air' => $this->air,
            'total' => $this->total,
        ];
    }
}
