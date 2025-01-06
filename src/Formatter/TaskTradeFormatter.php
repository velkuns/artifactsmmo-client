<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskTrade>
 */
class TaskTradeFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskTrade> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskTrade
    {
        return new VO\TaskTrade(
            $data->code,
            $data->quantity,
        );
    }
}
