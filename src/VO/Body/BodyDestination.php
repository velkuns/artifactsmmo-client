<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyDestination implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @return array{
     *     x: int,
     *     y: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
