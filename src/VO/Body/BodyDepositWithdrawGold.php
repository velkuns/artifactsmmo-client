<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyDepositWithdrawGold implements JsonSerializable
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
