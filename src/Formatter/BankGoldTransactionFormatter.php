<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BankGoldTransaction>
 */
class BankGoldTransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BankGoldTransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BankGoldTransaction
    {
        return new VO\BankGoldTransaction(
            CooldownFormatter::formatItem($data->cooldown),
            GoldFormatter::formatItem($data->bank),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
