<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Bank>
 */
class BankFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Bank> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Bank
    {
        return new VO\Bank(
            $data->slots,
            $data->expansions,
            $data->next_expansion_cost,
            $data->gold,
        );
    }
}
