<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GETransaction>
 */
class GETransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\GETransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GETransaction
    {
        return new VO\GETransaction(
            $data->code,
            $data->quantity,
            $data->price,
            $data->total_price,
        );
    }
}
