<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyAddCharacter implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly string $skin,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     skin: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'skin' => $this->skin,
        ];
    }
}
