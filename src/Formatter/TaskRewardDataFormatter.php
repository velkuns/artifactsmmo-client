<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskRewardData>
 */
class TaskRewardDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskRewardData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskRewardData
    {
        return new VO\TaskRewardData(
            CooldownFormatter::formatItem($data->cooldown),
            TaskRewardFormatter::formatItem($data->reward),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
