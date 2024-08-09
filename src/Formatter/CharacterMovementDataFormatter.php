<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\CharacterMovementData>
 */
class CharacterMovementDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\CharacterMovementData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\CharacterMovementData
    {
        return new VO\CharacterMovementData(
            CooldownFormatter::formatItem($data->cooldown),
            MapFormatter::formatItem($data->destination),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
