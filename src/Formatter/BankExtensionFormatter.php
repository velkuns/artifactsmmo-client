<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\BankExtension>
 */
class BankExtensionFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\BankExtension> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\BankExtension
    {
        return new VO\BankExtension(
            $data->price,
        );
    }
}
