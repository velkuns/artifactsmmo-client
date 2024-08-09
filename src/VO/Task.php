<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Task implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $code,
        public readonly string $type,
        public readonly int $total,
    ) {}

    /**
     * @return array{
     *     code: string,
     *     type: string,
     *     total: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'code' => $this->code,
            'type' => $this->type,
            'total' => $this->total,
        ];
    }
}
