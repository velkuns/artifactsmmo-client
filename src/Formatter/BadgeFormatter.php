<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Badge>
 * @implements ListFormatterInterface<VO\Badge>
 */
class BadgeFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\Badge> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Badge
    {
        return new VO\Badge(
            $data->code,
            $data->season ?? null,
            $data->description,
            BadgeConditionFormatter::formatItemList($data->conditions),
        );
    }
}
