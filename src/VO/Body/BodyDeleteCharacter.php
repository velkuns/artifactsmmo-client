<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyDeleteCharacter implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
    ) {}

    /**
     * @return array{
     *     name: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
        ];
    }
}
