<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyGEBuyOrder implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $id,
        public readonly int $quantity,
    ) {}

    /**
     * @return array{
     *     id: string,
     *     quantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
        ];
    }
}
