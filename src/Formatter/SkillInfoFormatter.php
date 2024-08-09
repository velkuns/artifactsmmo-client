<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\SkillInfo>
 */
class SkillInfoFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\SkillInfo> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\SkillInfo
    {
        return new VO\SkillInfo(
            $data->xp,
            DropFormatter::formatItemList($data->items),
        );
    }
}
