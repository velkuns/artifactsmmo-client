<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Drop>
 */
class DropFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Drop> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Drop
    {
        return new VO\Drop(
            $data->code,
            $data->quantity,
        );
    }
}
