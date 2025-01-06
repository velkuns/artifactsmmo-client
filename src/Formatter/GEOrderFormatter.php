<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GEOrder>
 * @implements ListFormatterInterface<VO\GEOrder>
 */
class GEOrderFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\GEOrder> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GEOrder
    {
        return new VO\GEOrder(
            $data->id,
            $data->seller,
            $data->code,
            $data->quantity,
            $data->price,
            $data->created_at,
        );
    }
}
