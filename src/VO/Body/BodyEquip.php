<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyEquip implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly string $slot,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     slot: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'slot' => $this->slot,
        ];
    }
}
