<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\Response>
 */
class ResponseFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\Response> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\Response
    {
        return new VO\Response(
            $data->message,
        );
    }
}
