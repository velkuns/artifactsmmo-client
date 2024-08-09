<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Item implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|ItemEffect[] $effects
     */
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly int $level,
        public readonly string $type,
        public readonly string $subtype,
        public readonly string $description,
        public readonly null|array $effects,
        public readonly null|Craft $craft,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     code: string,
     *     level: int,
     *     type: string,
     *     subtype: string,
     *     description: string,
     *     effects: null|ItemEffect[],
     *     craft: null|Craft,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'level' => $this->level,
            'type' => $this->type,
            'subtype' => $this->subtype,
            'description' => $this->description,
            'effects' => $this->effects,
            'craft' => $this->craft,
        ];
    }
}
