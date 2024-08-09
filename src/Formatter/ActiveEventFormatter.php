<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\ActiveEvent>
 */
class ActiveEventFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\ActiveEvent> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\ActiveEvent
    {
        return new VO\ActiveEvent(
            $data->name,
            MapFormatter::formatItem($data->map),
            $data->previous_skin,
            $data->duration,
            $data->expiration,
            $data->created_at,
        );
    }
}
