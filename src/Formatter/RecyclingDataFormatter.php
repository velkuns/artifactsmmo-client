<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\RecyclingData>
 */
class RecyclingDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\RecyclingData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\RecyclingData
    {
        return new VO\RecyclingData(
            CooldownFormatter::formatItem($data->cooldown),
            RecyclingItemsFormatter::formatItem($data->details),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
