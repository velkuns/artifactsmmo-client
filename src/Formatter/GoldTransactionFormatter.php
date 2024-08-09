<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GoldTransaction>
 */
class GoldTransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\GoldTransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GoldTransaction
    {
        return new VO\GoldTransaction(
            CooldownFormatter::formatItem($data->cooldown),
            GoldFormatter::formatItem($data->bank),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
