<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\DeleteItem>
 */
class DeleteItemFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\DeleteItem> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\DeleteItem
    {
        return new VO\DeleteItem(
            CooldownFormatter::formatItem($data->cooldown),
            SimpleItemFormatter::formatItem($data->item),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
