<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BankExtension implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $price,
    ) {}

    /**
     * @return array{
     *     price: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'price' => $this->price,
        ];
    }
}
