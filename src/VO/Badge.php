<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Badge implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param BadgeCondition[] $conditions
     */
    public function __construct(
        public readonly string $code,
        public readonly null|int $season,
        public readonly string $description,
        public readonly array $conditions,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     season: null|int,
     *     description: string,
     *     conditions: BadgeCondition[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'season' => $this->season,
            'description' => $this->description,
            'conditions' => $this->conditions,
        ];
    }
}
