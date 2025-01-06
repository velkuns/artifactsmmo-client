<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class AccountLeaderboard implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $position,
        public readonly string $account,
        public readonly string $status,
        public readonly int $achievementsPoints,
    ) {}

    /**
     * @return array{
     *     position: int,
     *     account: string,
     *     status: string,
     *     achievementsPoints: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'position' => $this->position,
            'account' => $this->account,
            'status' => $this->status,
            'achievementsPoints' => $this->achievementsPoints,
        ];
    }
}
