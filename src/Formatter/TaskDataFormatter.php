<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskData>
 */
class TaskDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskData
    {
        return new VO\TaskData(
            CooldownFormatter::formatItem($data->cooldown),
            TaskFormatter::formatItem($data->task),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
