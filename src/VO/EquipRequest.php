<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class EquipRequest implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly Cooldown $cooldown,
        public readonly string $slot,
        public readonly Item $item,
        public readonly Character $character,
    ) {}

    /**
     * @return array{
     *     cooldown: Cooldown,
     *     slot: string,
     *     item: Item,
     *     character: Character,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'cooldown' => $this->cooldown,
            'slot' => $this->slot,
            'item' => $this->item,
            'character' => $this->character,
        ];
    }
}
