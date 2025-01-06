<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskFull>
 * @implements ListFormatterInterface<VO\TaskFull>
 */
class TaskFullFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\TaskFull> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskFull
    {
        return new VO\TaskFull(
            $data->code,
            $data->level,
            $data->type,
            $data->min_quantity,
            $data->max_quantity,
            $data->skill,
            RewardsFormatter::formatItem($data->rewards),
        );
    }
}
