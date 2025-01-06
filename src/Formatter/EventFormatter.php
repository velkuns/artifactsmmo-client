<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\Event>
 */
class EventFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\Event> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Event
    {
        return new VO\Event(
            $data->name,
            $data->code,
            EventMapFormatter::formatItemList($data->maps),
            $data->skin,
            $data->duration,
            $data->rate,
            EventContentFormatter::formatItem($data->content),
        );
    }
}
