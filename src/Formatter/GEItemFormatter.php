<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GEItem>
 * @implements ListFormatterInterface<VO\GEItem>
 */
class GEItemFormatter implements FormatterInterface, ListFormatterInterface
{
    /** @use FormatterTrait<VO\GEItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GEItem
    {
        return new VO\GEItem(
            $data->code,
            $data->stock,
            $data->sell_price ?? null,
            $data->buy_price ?? null,
        );
    }
}
