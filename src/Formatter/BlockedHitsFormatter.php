<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BlockedHits>
 */
class BlockedHitsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BlockedHits> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BlockedHits
    {
        return new VO\BlockedHits(
            $data->fire,
            $data->earth,
            $data->water,
            $data->air,
            $data->total,
        );
    }
}
