<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TaskCancelled>
 */
class TaskCancelledFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TaskCancelled> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TaskCancelled
    {
        return new VO\TaskCancelled(
            CooldownFormatter::formatItem($data->cooldown),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
