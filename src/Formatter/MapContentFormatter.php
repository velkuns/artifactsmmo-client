<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\MapContent>
 */
class MapContentFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\MapContent> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\MapContent
    {
        return new VO\MapContent(
            $data->type,
            $data->code,
        );
    }
}
