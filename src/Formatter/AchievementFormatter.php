<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\Achievement>
 */
class AchievementFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\Achievement> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Achievement
    {
        return new VO\Achievement(
            $data->name,
            $data->code,
            $data->description,
            $data->points,
            $data->type,
            $data->target,
            $data->total,
            $data->current,
            $data->completed_at,
        );
    }
}
