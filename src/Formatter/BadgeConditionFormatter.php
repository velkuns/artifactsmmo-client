<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BadgeCondition>
 */
class BadgeConditionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BadgeCondition> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BadgeCondition
    {
        return new VO\BadgeCondition(
            $data->code,
            $data->quantity,
        );
    }
}
