<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Map implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly string $skin,
        public readonly int $x,
        public readonly int $y,
        public readonly null|MapContent $content,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     skin: string,
     *     x: int,
     *     y: int,
     *     content: null|MapContent,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'skin' => $this->skin,
            'x' => $this->x,
            'y' => $this->y,
            'content' => $this->content,
        ];
    }
}
