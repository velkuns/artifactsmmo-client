<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GEOrderCreated>
 */
class GEOrderCreatedFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\GEOrderCreated> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GEOrderCreated
    {
        return new VO\GEOrderCreated(
            $data->id,
            $data->created_at,
            $data->code,
            $data->quantity,
            $data->price,
            $data->total_price,
            $data->tax,
        );
    }
}
