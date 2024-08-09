<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Gold implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly int $quantity,
    ) {}

    /**
     * @return array{
     *     quantity: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'quantity' => $this->quantity,
        ];
    }
}
