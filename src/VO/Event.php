<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Event implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param EventMap[] $maps
     */
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly array $maps,
        public readonly string $skin,
        public readonly int $duration,
        public readonly int $rate,
        public readonly EventContent $content,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     code: string,
     *     maps: EventMap[],
     *     skin: string,
     *     duration: int,
     *     rate: int,
     *     content: EventContent,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'maps' => $this->maps,
            'skin' => $this->skin,
            'duration' => $this->duration,
            'rate' => $this->rate,
            'content' => $this->content,
        ];
    }
}
