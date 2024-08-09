<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class MapContent implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $type,
        public readonly string $code,
    ) {}

    /**
     * @return array{
     *     type: string,
     *     code: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'type' => $this->type,
            'code' => $this->code,
        ];
    }
}
