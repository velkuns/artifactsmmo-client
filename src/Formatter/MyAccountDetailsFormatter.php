<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\MyAccountDetails>
 */
class MyAccountDetailsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\MyAccountDetails> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\MyAccountDetails
    {
        return new VO\MyAccountDetails(
            $data->username,
            $data->email,
            $data->subscribed,
            $data->status,
            $data->badges ?? [],
            $data->gems,
            $data->achievements_points,
            $data->banned,
            $data->ban_reason ?? null,
        );
    }
}
