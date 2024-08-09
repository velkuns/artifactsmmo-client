<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BankItem>
 */
class BankItemFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BankItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BankItem
    {
        return new VO\BankItem(
            CooldownFormatter::formatItem($data->cooldown),
            ItemFormatter::formatItem($data->item),
            SimpleItemFormatter::formatItemList($data->bank),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
