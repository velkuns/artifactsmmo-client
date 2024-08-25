<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BankItemTransaction>
 */
class BankItemTransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BankItemTransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BankItemTransaction
    {
        return new VO\BankItemTransaction(
            CooldownFormatter::formatItem($data->cooldown),
            ItemFormatter::formatItem($data->item),
            SimpleItemFormatter::formatItemList($data->bank),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
