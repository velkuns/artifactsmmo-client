<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BankExtensionTransaction>
 */
class BankExtensionTransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BankExtensionTransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BankExtensionTransaction
    {
        return new VO\BankExtensionTransaction(
            CooldownFormatter::formatItem($data->cooldown),
            BankExtensionFormatter::formatItem($data->transaction),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
