<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Status>
 */
class StatusFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Status> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Status
    {
        return new VO\Status(
            $data->status,
            $data->version ?? null,
            $data->max_level,
            $data->characters_online,
            $data->server_time,
            AnnouncementFormatter::formatItemList($data->announcements),
            $data->last_wipe,
            $data->next_wipe,
        );
    }
}
