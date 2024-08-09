<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Item>
 * @implements ListFormatterInterface<VO\Item>
 */
class ItemFormatter implements FormatterInterface, ListFormatterInterface
{
    /** @use FormatterTrait<VO\Item> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Item
    {
        return new VO\Item(
            $data->name,
            $data->code,
            $data->level,
            $data->type,
            $data->subtype,
            $data->description,
            ItemEffectFormatter::formatItemList($data->effects ?? []),
            isset($data->craft) ? CraftFormatter::formatItem($data->craft) : null,
        );
    }
}
