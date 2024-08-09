<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class InventorySlot implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $slot,
        public readonly string $code,
        public readonly int $quantity,
    ) {}

    /**
     * @return array{
     *     slot: int,
     *     code: string,
     *     quantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'slot' => $this->slot,
            'code' => $this->code,
            'quantity' => $this->quantity,
        ];
    }
}
