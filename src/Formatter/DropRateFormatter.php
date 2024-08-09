<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\DropRate>
 */
class DropRateFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\DropRate> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\DropRate
    {
        return new VO\DropRate(
            $data->code,
            $data->rate,
            $data->min_quantity,
            $data->max_quantity,
        );
    }
}
