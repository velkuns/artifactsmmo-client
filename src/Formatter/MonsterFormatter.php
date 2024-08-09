<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Monster>
 * @implements ListFormatterInterface<VO\Monster>
 */
class MonsterFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\Monster> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Monster
    {
        return new VO\Monster(
            $data->name,
            $data->code,
            $data->level,
            $data->hp,
            $data->attack_fire,
            $data->attack_earth,
            $data->attack_water,
            $data->attack_air,
            $data->res_fire,
            $data->res_earth,
            $data->res_water,
            $data->res_air,
            $data->min_gold,
            $data->max_gold,
            DropRateFormatter::formatItemList($data->drops),
        );
    }
}
