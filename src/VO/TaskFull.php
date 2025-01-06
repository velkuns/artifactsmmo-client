<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class TaskFull implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly int $level,
        public readonly string $type,
        public readonly int $minQuantity,
        public readonly int $maxQuantity,
        public readonly null|string $skill,
        public readonly Rewards $rewards,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     level: int,
     *     type: string,
     *     minQuantity: int,
     *     maxQuantity: int,
     *     skill: null|string,
     *     rewards: Rewards,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'level' => $this->level,
            'type' => $this->type,
            'minQuantity' => $this->minQuantity,
            'maxQuantity' => $this->maxQuantity,
            'skill' => $this->skill,
            'rewards' => $this->rewards,
        ];
    }
}
