<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Response implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $message,
    ) {}

    /**
     * @return array{
     *     message: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'message' => $this->message,
        ];
    }
}
