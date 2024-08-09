<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Fight>
 */
class FightFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Fight> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Fight
    {
        return new VO\Fight(
            $data->xp,
            $data->gold,
            DropFormatter::formatItemList($data->drops),
            $data->turns,
            BlockedHitsFormatter::formatItem($data->monster_blocked_hits),
            BlockedHitsFormatter::formatItem($data->player_blocked_hits),
            $data->logs,
            $data->result,
        );
    }
}
