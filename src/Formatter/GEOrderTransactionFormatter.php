<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\GEOrderTransaction>
 */
class GEOrderTransactionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\GEOrderTransaction> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\GEOrderTransaction
    {
        return new VO\GEOrderTransaction(
            CooldownFormatter::formatItem($data->cooldown),
            GEOrderCreatedFormatter::formatItem($data->order),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
