<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class CharacterLeaderboard implements JsonSerializable
{
    use JsonSerializableTrait;

    public function __construct(
        public readonly string $name,
        public readonly string $skin,
        public readonly int $achievementsPoints,
        public readonly int $level,
        public readonly int $totalXp,
        public readonly int $miningLevel,
        public readonly int $miningTotalXp,
        public readonly int $woodcuttingLevel,
        public readonly int $woodcuttingTotalXp,
        public readonly int $fishingLevel,
        public readonly int $fishingTotalXp,
        public readonly int $weaponcraftingLevel,
        public readonly int $weaponcraftingTotalXp,
        public readonly int $gearcraftingLevel,
        public readonly int $gearcraftingTotalXp,
        public readonly int $jewelrycraftingLevel,
        public readonly int $jewelrycraftingTotalXp,
        public readonly int $cookingLevel,
        public readonly int $cookingTotalXp,
        public readonly int $gold,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     skin: string,
     *     achievementsPoints: int,
     *     level: int,
     *     totalXp: int,
     *     miningLevel: int,
     *     miningTotalXp: int,
     *     woodcuttingLevel: int,
     *     woodcuttingTotalXp: int,
     *     fishingLevel: int,
     *     fishingTotalXp: int,
     *     weaponcraftingLevel: int,
     *     weaponcraftingTotalXp: int,
     *     gearcraftingLevel: int,
     *     gearcraftingTotalXp: int,
     *     jewelrycraftingLevel: int,
     *     jewelrycraftingTotalXp: int,
     *     cookingLevel: int,
     *     cookingTotalXp: int,
     *     gold: int,
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'skin' => $this->skin,
            'achievementsPoints' => $this->achievementsPoints,
            'level' => $this->level,
            'totalXp' => $this->totalXp,
            'miningLevel' => $this->miningLevel,
            'miningTotalXp' => $this->miningTotalXp,
            'woodcuttingLevel' => $this->woodcuttingLevel,
            'woodcuttingTotalXp' => $this->woodcuttingTotalXp,
            'fishingLevel' => $this->fishingLevel,
            'fishingTotalXp' => $this->fishingTotalXp,
            'weaponcraftingLevel' => $this->weaponcraftingLevel,
            'weaponcraftingTotalXp' => $this->weaponcraftingTotalXp,
            'gearcraftingLevel' => $this->gearcraftingLevel,
            'gearcraftingTotalXp' => $this->gearcraftingTotalXp,
            'jewelrycraftingLevel' => $this->jewelrycraftingLevel,
            'jewelrycraftingTotalXp' => $this->jewelrycraftingTotalXp,
            'cookingLevel' => $this->cookingLevel,
            'cookingTotalXp' => $this->cookingTotalXp,
            'gold' => $this->gold,
        ];
    }
}
