<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\SimpleItem>
 * @implements ListFormatterInterface<VO\SimpleItem>
 */
class SimpleItemFormatter implements FormatterInterface, ListFormatterInterface
{
    /** @use FormatterTrait<VO\SimpleItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\SimpleItem
    {
        return new VO\SimpleItem(
            $data->code,
            $data->quantity,
        );
    }
}
