<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements ListFormatterInterface<VO\Log>
 */
class LogFormatter implements ListFormatterInterface
{
    /** @use FormatterTrait<VO\Log> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Log
    {
        return new VO\Log(
            $data->character,
            $data->account,
            $data->type,
            $data->description,
            $data->content,
            $data->cooldown,
            $data->cooldown_expiration,
            $data->created_at,
        );
    }
}
