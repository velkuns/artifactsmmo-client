<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BaseAchievement>
 * @implements ListFormatterInterface<VO\BaseAchievement>
 */
class BaseAchievementFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\BaseAchievement> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BaseAchievement
    {
        return new VO\BaseAchievement(
            $data->name,
            $data->code,
            $data->description,
            $data->points,
            $data->type,
            $data->target,
            $data->total,
        );
    }
}
