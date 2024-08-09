<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\EquipRequest>
 */
class EquipRequestFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\EquipRequest> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\EquipRequest
    {
        return new VO\EquipRequest(
            CooldownFormatter::formatItem($data->cooldown),
            $data->slot,
            ItemFormatter::formatItem($data->item),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
