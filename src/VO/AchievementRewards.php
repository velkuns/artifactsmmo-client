<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class AchievementRewards implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $gold,
    ) {}

    /**
     * @return array{
     *     gold: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'gold' => $this->gold,
        ];
    }
}
