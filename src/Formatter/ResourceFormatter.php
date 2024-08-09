<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Resource>
 * @implements ListFormatterInterface<VO\Resource>
 */
class ResourceFormatter implements ListFormatterInterface, FormatterInterface
{
    /** @use FormatterTrait<VO\Resource> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Resource
    {
        return new VO\Resource(
            $data->name,
            $data->code,
            $data->skill,
            $data->level,
            DropRateFormatter::formatItemList($data->drops),
        );
    }
}
