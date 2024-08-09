<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class GETransaction implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly int $quantity,
        public readonly int $price,
        public readonly int $totalPrice,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     quantity: int,
     *     price: int,
     *     totalPrice: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'totalPrice' => $this->totalPrice,
        ];
    }
}
