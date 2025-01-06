<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\EventMap>
 */
class EventMapFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\EventMap> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\EventMap
    {
        return new VO\EventMap(
            $data->x,
            $data->y,
        );
    }
}
