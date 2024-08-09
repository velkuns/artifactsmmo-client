<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\TokenResponse>
 */
class TokenResponseFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\TokenResponse> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\TokenResponse
    {
        return new VO\TokenResponse(
            $data->token,
        );
    }
}
