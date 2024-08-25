<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Status implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param Announcement[] $announcements
     */
    public function __construct(
        public readonly string $status,
        public readonly null|string $version,
        public readonly int $maxLevel,
        public readonly int $charactersOnline,
        public readonly string $serverTime,
        public readonly array $announcements,
        public readonly string $lastWipe,
        public readonly string $nextWipe,
    ) {}

    /**
     * @return array{
     *     status: string,
     *     version: null|string,
     *     maxLevel: int,
     *     charactersOnline: int,
     *     serverTime: string,
     *     announcements: Announcement[],
     *     lastWipe: string,
     *     nextWipe: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'status' => $this->status,
            'version' => $this->version,
            'maxLevel' => $this->maxLevel,
            'charactersOnline' => $this->charactersOnline,
            'serverTime' => $this->serverTime,
            'announcements' => $this->announcements,
            'lastWipe' => $this->lastWipe,
            'nextWipe' => $this->nextWipe,
        ];
    }
}
