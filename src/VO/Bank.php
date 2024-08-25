<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Bank implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $slots,
        public readonly int $expansions,
        public readonly int $nextExpansionCost,
        public readonly int $gold,
    ) {}

    /**
     * @return array{
     *     slots: int,
     *     expansions: int,
     *     nextExpansionCost: int,
     *     gold: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'slots' => $this->slots,
            'expansions' => $this->expansions,
            'nextExpansionCost' => $this->nextExpansionCost,
            'gold' => $this->gold,
        ];
    }
}
