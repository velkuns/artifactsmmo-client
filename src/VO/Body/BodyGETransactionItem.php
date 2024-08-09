<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyGETransactionItem implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly int $quantity,
        public readonly int $price,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     quantity: int,
     *     price: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
