<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Map>
 * @implements ListFormatterInterface<VO\Map>
 */
class MapFormatter implements FormatterInterface, ListFormatterInterface
{
    /** @use FormatterTrait<VO\Map> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Map
    {
        return new VO\Map(
            $data->name,
            $data->skin,
            $data->x,
            $data->y,
            MapContentFormatter::formatItem($data->content),
        );
    }
}
