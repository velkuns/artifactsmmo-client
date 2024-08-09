<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class TokenResponse implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $token,
    ) {}

    /**
     * @return array{
     *     token: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'token' => $this->token,
        ];
    }
}
