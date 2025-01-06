<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Rewards>
 */
class RewardsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Rewards> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Rewards
    {
        return new VO\Rewards(
            SimpleItemFormatter::formatItemList($data->items),
            $data->gold,
        );
    }
}
