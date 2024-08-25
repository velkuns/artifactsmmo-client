<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Character>
 * @implements ListFormatterInterface<VO\Character>
 */
class CharacterFormatter implements FormatterInterface, ListFormatterInterface
{
    /** @use FormatterTrait<VO\Character> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Character
    {
        return new VO\Character(
            $data->name,
            $data->skin,
            $data->level,
            $data->xp,
            $data->max_xp,
            $data->achievements_points,
            $data->gold,
            $data->speed,
            $data->mining_level,
            $data->mining_xp,
            $data->mining_max_xp,
            $data->woodcutting_level,
            $data->woodcutting_xp,
            $data->woodcutting_max_xp,
            $data->fishing_level,
            $data->fishing_xp,
            $data->fishing_max_xp,
            $data->weaponcrafting_level,
            $data->weaponcrafting_xp,
            $data->weaponcrafting_max_xp,
            $data->gearcrafting_level,
            $data->gearcrafting_xp,
            $data->gearcrafting_max_xp,
            $data->jewelrycrafting_level,
            $data->jewelrycrafting_xp,
            $data->jewelrycrafting_max_xp,
            $data->cooking_level,
            $data->cooking_xp,
            $data->cooking_max_xp,
            $data->hp,
            $data->haste,
            $data->critical_strike,
            $data->stamina,
            $data->attack_fire,
            $data->attack_earth,
            $data->attack_water,
            $data->attack_air,
            $data->dmg_fire,
            $data->dmg_earth,
            $data->dmg_water,
            $data->dmg_air,
            $data->res_fire,
            $data->res_earth,
            $data->res_water,
            $data->res_air,
            $data->x,
            $data->y,
            $data->cooldown,
            $data->cooldown_expiration ?? null,
            $data->weapon_slot,
            $data->shield_slot,
            $data->helmet_slot,
            $data->body_armor_slot,
            $data->leg_armor_slot,
            $data->boots_slot,
            $data->ring1_slot,
            $data->ring2_slot,
            $data->amulet_slot,
            $data->artifact1_slot,
            $data->artifact2_slot,
            $data->artifact3_slot,
            $data->consumable1_slot,
            $data->consumable1_slot_quantity,
            $data->consumable2_slot,
            $data->consumable2_slot_quantity,
            $data->task,
            $data->task_type,
            $data->task_progress,
            $data->task_total,
            $data->inventory_max_items,
            InventorySlotFormatter::formatItemList($data->inventory ?? []),
        );
    }
}
