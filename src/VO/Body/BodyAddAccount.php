<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO\Body;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BodyAddAccount implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $email,
    ) {}

    /**
     * @return array{
     *     username: string,
     *     password: string,
     *     email: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
        ];
    }
}
