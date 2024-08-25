<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class TaskCancelled implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly Cooldown $cooldown,
        public readonly Character $character,
    ) {}

    /**
     * @return array{
     *     cooldown: Cooldown,
     *     character: Character,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'cooldown' => $this->cooldown,
            'character' => $this->character,
        ];
    }
}
