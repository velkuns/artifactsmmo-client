<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\CharacterRestData>
 */
class CharacterRestDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\CharacterRestData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\CharacterRestData
    {
        return new VO\CharacterRestData(
            CooldownFormatter::formatItem($data->cooldown),
            $data->hp_restored,
            CharacterFormatter::formatItem($data->character),
        );
    }
}
