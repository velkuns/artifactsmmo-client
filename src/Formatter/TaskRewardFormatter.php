<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskReward>
 */
class TaskRewardFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskReward> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskReward
    {
        return new VO\TaskReward(
            $data->code,
            $data->quantity,
        );
    }
}
