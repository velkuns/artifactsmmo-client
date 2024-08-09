<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\RecyclingItems>
 */
class RecyclingItemsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\RecyclingItems> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\RecyclingItems
    {
        return new VO\RecyclingItems(
            DropFormatter::formatItemList($data->items),
        );
    }
}
