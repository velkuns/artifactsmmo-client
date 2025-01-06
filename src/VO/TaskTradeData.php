<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class TaskTradeData implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly Cooldown $cooldown,
        public readonly TaskTrade $trade,
        public readonly Character $character,
    ) {}

    /**
     * @return array{
     *     cooldown: Cooldown,
     *     trade: TaskTrade,
     *     character: Character,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'cooldown' => $this->cooldown,
            'trade' => $this->trade,
            'character' => $this->character,
        ];
    }
}
