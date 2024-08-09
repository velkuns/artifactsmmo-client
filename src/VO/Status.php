<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Status implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|Announcement[] $announcements
     */
    public function __construct(
        public readonly string $status,
        public readonly null|string $version,
        public readonly null|int $charactersOnline,
        public readonly null|string $serverTime,
        public readonly null|array $announcements,
        public readonly string $lastWipe,
        public readonly string $nextWipe,
    ) {}

    /**
     * @return array{
     *     status: string,
     *     version: null|string,
     *     charactersOnline: null|int,
     *     serverTime: null|string,
     *     announcements: null|Announcement[],
     *     lastWipe: string,
     *     nextWipe: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'status' => $this->status,
            'version' => $this->version,
            'charactersOnline' => $this->charactersOnline,
            'serverTime' => $this->serverTime,
            'announcements' => $this->announcements,
            'lastWipe' => $this->lastWipe,
            'nextWipe' => $this->nextWipe,
        ];
    }
}
