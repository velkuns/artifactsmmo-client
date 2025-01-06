<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\UseItem>
 */
class UseItemFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\UseItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\UseItem
    {
        return new VO\UseItem(
            CooldownFormatter::formatItem($data->cooldown),
            ItemFormatter::formatItem($data->item),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
