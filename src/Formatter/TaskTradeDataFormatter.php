<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskTradeData>
 */
class TaskTradeDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskTradeData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskTradeData
    {
        return new VO\TaskTradeData(
            CooldownFormatter::formatItem($data->cooldown),
            TaskTradeFormatter::formatItem($data->trade),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
