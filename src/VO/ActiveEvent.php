<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class ActiveEvent implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly Map $map,
        public readonly string $previousSkin,
        public readonly int $duration,
        public readonly string $expiration,
        public readonly string $createdAt,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     map: Map,
     *     previousSkin: string,
     *     duration: int,
     *     expiration: string,
     *     createdAt: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'map' => $this->map,
            'previousSkin' => $this->previousSkin,
            'duration' => $this->duration,
            'expiration' => $this->expiration,
            'createdAt' => $this->createdAt,
        ];
    }
}
