<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Task>
 */
class TaskFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Task> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Task
    {
        return new VO\Task(
            $data->code,
            $data->type,
            $data->total,
        );
    }
}
