<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\AchievementRewards>
 */
class AchievementRewardsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\AchievementRewards> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\AchievementRewards
    {
        return new VO\AchievementRewards(
            $data->gold,
        );
    }
}
