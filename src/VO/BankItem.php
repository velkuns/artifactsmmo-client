<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class BankItem implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param SimpleItem[] $bank
     */
    public function __construct(
        public readonly Cooldown $cooldown,
        public readonly Item $item,
        public readonly array $bank,
        public readonly Character $character,
    ) {}

    /**
     * @return array{
     *     cooldown: Cooldown,
     *     item: Item,
     *     bank: SimpleItem[],
     *     character: Character,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'cooldown' => $this->cooldown,
            'item' => $this->item,
            'bank' => $this->bank,
            'character' => $this->character,
        ];
    }
}
