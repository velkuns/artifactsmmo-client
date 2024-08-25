<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BaseAchievement implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly string $description,
        public readonly int $points,
        public readonly string $type,
        public readonly null|string $target,
        public readonly int $total,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     code: string,
     *     description: string,
     *     points: int,
     *     type: string,
     *     target: null|string,
     *     total: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'points' => $this->points,
            'type' => $this->type,
            'target' => $this->target,
            'total' => $this->total,
        ];
    }
}
