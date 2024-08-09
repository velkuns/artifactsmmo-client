<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

use Velkuns\ArtifactsMMO\VO;

/**
 * @implements FormatterInterface<VO\InventorySlot>
 */
class InventorySlotFormatter implements FormatterInterface
{
    /** @use FormatterTrait<VO\InventorySlot> */
    use FormatterTrait;

    public static function formatItem(\stdClass $data): VO\InventorySlot
    {
        return new VO\InventorySlot(
            $data->slot,
            $data->code,
            $data->quantity,
        );
    }
}
