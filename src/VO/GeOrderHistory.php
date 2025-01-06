<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class GeOrderHistory implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $orderId,
        public readonly string $seller,
        public readonly string $buyer,
        public readonly string $code,
        public readonly int $quantity,
        public readonly int $price,
        public readonly string $soldAt,
    ) {}

    /**
     * @return array{
     *     orderId: string,
     *     seller: string,
     *     buyer: string,
     *     code: string,
     *     quantity: int,
     *     price: int,
     *     soldAt: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'orderId' => $this->orderId,
            'seller' => $this->seller,
            'buyer' => $this->buyer,
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'soldAt' => $this->soldAt,
        ];
    }
}
