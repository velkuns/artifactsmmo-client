<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\AccountAchievement>
 */
class AccountAchievementFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\AccountAchievement> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\AccountAchievement
    {
        return new VO\AccountAchievement(
            $data->name,
            $data->code,
            $data->description,
            $data->points,
            $data->type,
            $data->target,
            $data->total,
            AchievementRewardsFormatter::formatItem($data->rewards),
            $data->current,
            $data->completed_at,
        );
    }
}
