<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\EventContent>
 */
class EventContentFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\EventContent> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\EventContent
    {
        return new VO\EventContent(
            $data->type,
            $data->code,
        );
    }
}
