<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyChangePassword implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $currentPassword,
        public readonly string $newPassword,
    ) {}

    /**
     * @return array{
     *     currentPassword: string,
     *     newPassword: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'currentPassword' => $this->currentPassword,
            'newPassword' => $this->newPassword,
        ];
    }
}
