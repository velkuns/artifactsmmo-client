<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\CharacterFightData>
 */
class CharacterFightDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\CharacterFightData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\CharacterFightData
    {
        return new VO\CharacterFightData(
            CooldownFormatter::formatItem($data->cooldown),
            FightFormatter::formatItem($data->fight),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
