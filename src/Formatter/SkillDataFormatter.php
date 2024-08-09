<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\SkillData>
 */
class SkillDataFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\SkillData> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\SkillData
    {
        return new VO\SkillData(
            CooldownFormatter::formatItem($data->cooldown),
            SkillInfoFormatter::formatItem($data->details),
            CharacterFormatter::formatItem($data->character),
        );
    }
}
