<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\ItemEffect>
 */
class ItemEffectFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\ItemEffect> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\ItemEffect
    {
        return new VO\ItemEffect(
            $data->name,
            $data->value,
        );
    }
}
