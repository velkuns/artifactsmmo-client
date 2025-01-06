<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BadgeCondition implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly null|int $quantity,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     quantity: null|int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'quantity' => $this->quantity,
        ];
    }
}
