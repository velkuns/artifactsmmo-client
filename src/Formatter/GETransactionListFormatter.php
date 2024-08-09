<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GETransactionList>
 */
class GETransactionListFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\GETransactionList> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GETransactionList
    {
        return new VO\GETransactionList(
            CooldownFormatter::formatItem($data->cooldown),
            GETransactionFormatter::formatItem($data->transaction),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
