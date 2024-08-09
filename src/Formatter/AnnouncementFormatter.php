<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Announcement>
 */
class AnnouncementFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Announcement> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Announcement
    {
        return new VO\Announcement(
            $data->message,
            $data->created_at ?? null,
        );
    }
}
