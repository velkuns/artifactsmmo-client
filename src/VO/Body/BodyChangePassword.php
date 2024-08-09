<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyChangePassword implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $password,
    ) {}

    /**
     * @return array{
     *     password: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'password' => $this->password,
        ];
    }
}
