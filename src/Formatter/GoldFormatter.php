<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Gold>
 */
class GoldFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Gold> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Gold
    {
        return new VO\Gold(
            $data->quantity,
        );
    }
}
