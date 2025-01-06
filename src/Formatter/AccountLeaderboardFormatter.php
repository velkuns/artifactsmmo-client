<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\AccountLeaderboard>
 */
class AccountLeaderboardFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\AccountLeaderboard> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\AccountLeaderboard
    {
        return new VO\AccountLeaderboard(
            $data->position,
            $data->account,
            $data->status,
            $data->achievements_points,
        );
    }
}
