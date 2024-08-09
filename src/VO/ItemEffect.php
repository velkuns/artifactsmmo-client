<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class ItemEffect implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly int $value,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     value: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
