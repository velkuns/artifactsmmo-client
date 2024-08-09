<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Resource implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param DropRate[] $drops
     */
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly string $skill,
        public readonly int $level,
        public readonly array $drops,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     code: string,
     *     skill: string,
     *     level: int,
     *     drops: DropRate[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'skill' => $this->skill,
            'level' => $this->level,
            'drops' => $this->drops,
        ];
    }
}
