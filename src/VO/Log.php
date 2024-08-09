<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Log implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $character,
        public readonly string $account,
        public readonly string $type,
        public readonly string $description,
        public readonly string $content,
        public readonly int $cooldown,
        public readonly string $cooldownExpiration,
        public readonly string $createdAt,
    ) {}

    /**
     * @return array{
     *     character: string,
     *     account: string,
     *     type: string,
     *     description: string,
     *     content: string,
     *     cooldown: int,
     *     cooldownExpiration: string,
     *     createdAt: string,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'character' => $this->character,
            'account' => $this->account,
            'type' => $this->type,
            'description' => $this->description,
            'content' => $this->content,
            'cooldown' => $this->cooldown,
            'cooldownExpiration' => $this->cooldownExpiration,
            'createdAt' => $this->createdAt,
        ];
    }
}
