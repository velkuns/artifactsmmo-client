<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Cooldown>
 */
class CooldownFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Cooldown> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Cooldown
    {
        return new VO\Cooldown(
            $data->total_seconds,
            $data->remaining_seconds,
            $data->started_at,
            $data->expiration,
            $data->reason,
        );
    }
}
