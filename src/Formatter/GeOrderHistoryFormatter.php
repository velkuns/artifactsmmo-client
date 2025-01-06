<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\GeOrderHistory>
 */
class GeOrderHistoryFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\GeOrderHistory> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GeOrderHistory
    {
        return new VO\GeOrderHistory(
            $data->order_id,
            $data->seller,
            $data->buyer,
            $data->code,
            $data->quantity,
            $data->price,
            $data->sold_at,
        );
    }
}
