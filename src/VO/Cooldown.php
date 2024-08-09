<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Cooldown implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $totalSeconds,
        public readonly int $remainingSeconds,
        public readonly string $startedAt,
        public readonly string $expiration,
        public readonly string $reason,
    ) {}

    /**
     * @return array{
     *     totalSeconds: int,
     *     remainingSeconds: int,
     *     startedAt: string,
     *     expiration: string,
     *     reason: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'totalSeconds' => $this->totalSeconds,
            'remainingSeconds' => $this->remainingSeconds,
            'startedAt' => $this->startedAt,
            'expiration' => $this->expiration,
            'reason' => $this->reason,
        ];
    }
}
