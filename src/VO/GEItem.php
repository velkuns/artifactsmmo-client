<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class GEItem implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly int $stock,
        public readonly null|int $sellPrice,
        public readonly null|int $buyPrice,
        public readonly int $maxQuantity,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     stock: int,
     *     sellPrice: null|int,
     *     buyPrice: null|int,
     *     maxQuantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'stock' => $this->stock,
            'sellPrice' => $this->sellPrice,
            'buyPrice' => $this->buyPrice,
            'maxQuantity' => $this->maxQuantity,
        ];
    }
}
