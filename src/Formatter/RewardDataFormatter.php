<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\RewardData>
 */
class RewardDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\RewardData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\RewardData
    {
        return new VO\RewardData(
            CooldownFormatter::formatItem($data->cooldown),
            RewardsFormatter::formatItem($data->rewards),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
