<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyGECancelOrder implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $id,
    ) {}

    /**
     * @return array{
     *     id: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'id' => $this->id,
        ];
    }
}
