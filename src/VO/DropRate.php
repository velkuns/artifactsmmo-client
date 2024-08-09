<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class DropRate implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly int $rate,
        public readonly int $minQuantity,
        public readonly int $maxQuantity,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     rate: int,
     *     minQuantity: int,
     *     maxQuantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'rate' => $this->rate,
            'minQuantity' => $this->minQuantity,
            'maxQuantity' => $this->maxQuantity,
        ];
    }
}
