<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class GEOrder implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $id,
        public readonly string $seller,
        public readonly string $code,
        public readonly int $quantity,
        public readonly int $price,
        public readonly string $createdAt,
    ) {}

    /**
     * @return array{
     *     id: string,
     *     seller: string,
     *     code: string,
     *     quantity: int,
     *     price: int,
     *     createdAt: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'id' => $this->id,
            'seller' => $this->seller,
            'code' => $this->code,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'createdAt' => $this->createdAt,
        ];
    }
}
