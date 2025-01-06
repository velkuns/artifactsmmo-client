<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class GEOrderCreated implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $id,
        public readonly string $createdAt,
        public readonly string $code,
        public readonly int $quantity,
        public readonly int $price,
        public readonly int $totalPrice,
        public readonly int $tax,
    ) {}

    /**
     * @return array{
     *     id: string,
     *     createdAt: string,
     *     code: string,
     *     quantity: int,
     *     price: int,
     *     totalPrice: int,
     *     tax: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'totalPrice' => $this->totalPrice,
            'tax' => $this->tax,
        ];
    }
}
