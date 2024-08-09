<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\SingleItem>
 */
class SingleItemFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\SingleItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\SingleItem
    {
        return new VO\SingleItem(
            ItemFormatter::formatItem($data->item),
            isset($data->ge) ? GEItemFormatter::formatItem($data->ge) : null,
        );
    }
}
