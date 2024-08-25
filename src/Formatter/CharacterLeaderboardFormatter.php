<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\CharacterLeaderboard>
 */
class CharacterLeaderboardFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\CharacterLeaderboard> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\CharacterLeaderboard
    {
        return new VO\CharacterLeaderboard(
            $data->name,
            $data->skin,
            $data->achievements_points,
            $data->level,
            $data->total_xp,
            $data->mining_level,
            $data->mining_total_xp,
            $data->woodcutting_level,
            $data->woodcutting_total_xp,
            $data->fishing_level,
            $data->fishing_total_xp,
            $data->weaponcrafting_level,
            $data->weaponcrafting_total_xp,
            $data->gearcrafting_level,
            $data->gearcrafting_total_xp,
            $data->jewelrycrafting_level,
            $data->jewelrycrafting_total_xp,
            $data->cooking_level,
            $data->cooking_total_xp,
            $data->gold,
        );
    }
}
