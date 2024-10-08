<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyUnequip implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $slot,
        public readonly int $quantity = 1,
    ) {}

    /**
     * @return array{
     *     slot: string,
     *     quantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'slot' => $this->slot,
            'quantity' => $this->quantity,
        ];
    }
}
