<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Craft>
 */
class CraftFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Craft> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Craft
    {
        return new VO\Craft(
            $data->skill ?? null,
            $data->level ?? null,
            SimpleItemFormatter::formatItemList($data->items ?? []),
            $data->quantity ?? null,
        );
    }
}
