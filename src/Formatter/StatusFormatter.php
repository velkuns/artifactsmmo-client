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
            $data->characters_online ?? null,
            $data->server_time ?? null,
            AnnouncementFormatter::formatItemList($data->announcements ?? []),
            $data->last_wipe,
            $data->next_wipe,
        );
    }
}
