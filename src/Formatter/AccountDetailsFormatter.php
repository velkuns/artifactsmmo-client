<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\AccountDetails>
 */
class AccountDetailsFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\AccountDetails> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\AccountDetails
    {
        return new VO\AccountDetails(
            $data->username,
            $data->subscribed,
            $data->status,
            $data->badges ?? [],
            $data->achievements_points,
            $data->banned,
            $data->ban_reason ?? null,
        );
    }
}
