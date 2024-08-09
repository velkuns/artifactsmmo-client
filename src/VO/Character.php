<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\VO;

use Eureka\Component\Serializer\JsonSerializableTrait;
use JsonSerializable;

class Character implements JsonSerializable
{
    use JsonSerializableTrait;
    /**
     * @param null|InventorySlot[] $inventory
     */
    public function __construct(
        public readonly string $name,
        public readonly string $skin,
        public readonly int $level,
        public readonly int $xp,
        public readonly int $maxXp,
        public readonly int $totalXp,
        public readonly int $gold,
        public readonly int $speed,
        public readonly int $miningLevel,
        public readonly int $miningXp,
        public readonly int $miningMaxXp,
        public readonly int $woodcuttingLevel,
        public readonly int $woodcuttingXp,
        public readonly int $woodcuttingMaxXp,
        public readonly int $fishingLevel,
        public readonly int $fishingXp,
        public readonly int $fishingMaxXp,
        public readonly int $weaponcraftingLevel,
        public readonly int $weaponcraftingXp,
        public readonly int $weaponcraftingMaxXp,
        public readonly int $gearcraftingLevel,
        public readonly int $gearcraftingXp,
        public readonly int $gearcraftingMaxXp,
        public readonly int $jewelrycraftingLevel,
        public readonly int $jewelrycraftingXp,
        public readonly int $jewelrycraftingMaxXp,
        public readonly int $cookingLevel,
        public readonly int $cookingXp,
        public readonly int $cookingMaxXp,
        public readonly int $hp,
        public readonly int $haste,
        public readonly int $criticalStrike,
        public readonly int $stamina,
        public readonly int $attackFire,
        public readonly int $attackEarth,
        public readonly int $attackWater,
        public readonly int $attackAir,
        public readonly int $dmgFire,
        public readonly int $dmgEarth,
        public readonly int $dmgWater,
        public readonly int $dmgAir,
        public readonly int $resFire,
        public readonly int $resEarth,
        public readonly int $resWater,
        public readonly int $resAir,
        public readonly int $x,
        public readonly int $y,
        public readonly int $cooldown,
        public readonly null|string $cooldownExpiration,
        public readonly string $weaponSlot,
        public readonly string $shieldSlot,
        public readonly string $helmetSlot,
        public readonly string $bodyArmorSlot,
        public readonly string $legArmorSlot,
        public readonly string $bootsSlot,
        public readonly string $ring1Slot,
        public readonly string $ring2Slot,
        public readonly string $amuletSlot,
        public readonly string $artifact1Slot,
        public readonly string $artifact2Slot,
        public readonly string $artifact3Slot,
        public readonly string $consumable1Slot,
        public readonly int $consumable1SlotQuantity,
        public readonly string $consumable2Slot,
        public readonly int $consumable2SlotQuantity,
        public readonly string $task,
        public readonly string $taskType,
        public readonly int $taskProgress,
        public readonly int $taskTotal,
        public readonly int $inventoryMaxItems,
        public readonly null|array $inventory,
    ) {}

    /**
     * @return array{
     *     name: string,
     *     skin: string,
     *     level: int,
     *     xp: int,
     *     maxXp: int,
     *     totalXp: int,
     *     gold: int,
     *     speed: int,
     *     miningLevel: int,
     *     miningXp: int,
     *     miningMaxXp: int,
     *     woodcuttingLevel: int,
     *     woodcuttingXp: int,
     *     woodcuttingMaxXp: int,
     *     fishingLevel: int,
     *     fishingXp: int,
     *     fishingMaxXp: int,
     *     weaponcraftingLevel: int,
     *     weaponcraftingXp: int,
     *     weaponcraftingMaxXp: int,
     *     gearcraftingLevel: int,
     *     gearcraftingXp: int,
     *     gearcraftingMaxXp: int,
     *     jewelrycraftingLevel: int,
     *     jewelrycraftingXp: int,
     *     jewelrycraftingMaxXp: int,
     *     cookingLevel: int,
     *     cookingXp: int,
     *     cookingMaxXp: int,
     *     hp: int,
     *     haste: int,
     *     criticalStrike: int,
     *     stamina: int,
     *     attackFire: int,
     *     attackEarth: int,
     *     attackWater: int,
     *     attackAir: int,
     *     dmgFire: int,
     *     dmgEarth: int,
     *     dmgWater: int,
     *     dmgAir: int,
     *     resFire: int,
     *     resEarth: int,
     *     resWater: int,
     *     resAir: int,
     *     x: int,
     *     y: int,
     *     cooldown: int,
     *     cooldownExpiration: null|string,
     *     weaponSlot: string,
     *     shieldSlot: string,
     *     helmetSlot: string,
     *     bodyArmorSlot: string,
     *     legArmorSlot: string,
     *     bootsSlot: string,
     *     ring1Slot: string,
     *     ring2Slot: string,
     *     amuletSlot: string,
     *     artifact1Slot: string,
     *     artifact2Slot: string,
     *     artifact3Slot: string,
     *     consumable1Slot: string,
     *     consumable1SlotQuantity: int,
     *     consumable2Slot: string,
     *     consumable2SlotQuantity: int,
     *     task: string,
     *     taskType: string,
     *     taskProgress: int,
     *     taskTotal: int,
     *     inventoryMaxItems: int,
     *     inventory: null|InventorySlot[],
     * }
     */
    public function jsonSerialize(
    ): array {
        return [
            'name' => $this->name,
            'skin' => $this->skin,
            'level' => $this->level,
            'xp' => $this->xp,
            'maxXp' => $this->maxXp,
            'totalXp' => $this->totalXp,
            'gold' => $this->gold,
            'speed' => $this->speed,
            'miningLevel' => $this->miningLevel,
            'miningXp' => $this->miningXp,
            'miningMaxXp' => $this->miningMaxXp,
            'woodcuttingLevel' => $this->woodcuttingLevel,
            'woodcuttingXp' => $this->woodcuttingXp,
            'woodcuttingMaxXp' => $this->woodcuttingMaxXp,
            'fishingLevel' => $this->fishingLevel,
            'fishingXp' => $this->fishingXp,
            'fishingMaxXp' => $this->fishingMaxXp,
            'weaponcraftingLevel' => $this->weaponcraftingLevel,
            'weaponcraftingXp' => $this->weaponcraftingXp,
            'weaponcraftingMaxXp' => $this->weaponcraftingMaxXp,
            'gearcraftingLevel' => $this->gearcraftingLevel,
            'gearcraftingXp' => $this->gearcraftingXp,
            'gearcraftingMaxXp' => $this->gearcraftingMaxXp,
            'jewelrycraftingLevel' => $this->jewelrycraftingLevel,
            'jewelrycraftingXp' => $this->jewelrycraftingXp,
            'jewelrycraftingMaxXp' => $this->jewelrycraftingMaxXp,
            'cookingLevel' => $this->cookingLevel,
            'cookingXp' => $this->cookingXp,
            'cookingMaxXp' => $this->cookingMaxXp,
            'hp' => $this->hp,
            'haste' => $this->haste,
            'criticalStrike' => $this->criticalStrike,
            'stamina' => $this->stamina,
            'attackFire' => $this->attackFire,
            'attackEarth' => $this->attackEarth,
            'attackWater' => $this->attackWater,
            'attackAir' => $this->attackAir,
            'dmgFire' => $this->dmgFire,
            'dmgEarth' => $this->dmgEarth,
            'dmgWater' => $this->dmgWater,
            'dmgAir' => $this->dmgAir,
            'resFire' => $this->resFire,
            'resEarth' => $this->resEarth,
            'resWater' => $this->resWater,
            'resAir' => $this->resAir,
            'x' => $this->x,
            'y' => $this->y,
            'cooldown' => $this->cooldown,
            'cooldownExpiration' => $this->cooldownExpiration,
            'weaponSlot' => $this->weaponSlot,
            'shieldSlot' => $this->shieldSlot,
            'helmetSlot' => $this->helmetSlot,
            'bodyArmorSlot' => $this->bodyArmorSlot,
            'legArmorSlot' => $this->legArmorSlot,
            'bootsSlot' => $this->bootsSlot,
            'ring1Slot' => $this->ring1Slot,
            'ring2Slot' => $this->ring2Slot,
            'amuletSlot' => $this->amuletSlot,
            'artifact1Slot' => $this->artifact1Slot,
            'artifact2Slot' => $this->artifact2Slot,
            'artifact3Slot' => $this->artifact3Slot,
            'consumable1Slot' => $this->consumable1Slot,
            'consumable1SlotQuantity' => $this->consumable1SlotQuantity,
            'consumable2Slot' => $this->consumable2Slot,
            'consumable2SlotQuantity' => $this->consumable2SlotQuantity,
            'task' => $this->task,
            'taskType' => $this->taskType,
            'taskProgress' => $this->taskProgress,
            'taskTotal' => $this->taskTotal,
            'inventoryMaxItems' => $this->inventoryMaxItems,
            'inventory' => $this->inventory,
        ];
    }
}
