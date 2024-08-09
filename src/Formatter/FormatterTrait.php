<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

/**
 * @template TEntity
 */
trait FormatterTrait
{
    /**
     * @return TEntity
     */
    abstract public static function formatItem(\stdClass $data);

    /**
     * @return TEntity
     */
    public function format(\stdClass $data)
    {
        return static::formatItem($data->data);
    }

    /**
     * @return TEntity[]
     */
    public function formatList(\stdClass $data): array
    {
        return static::formatItemList($data->data);
    }

    /**
     * @param \stdClass[] $data
     * @return TEntity[]
     */
    public static function formatItemList(array $data): array
    {
        $collection = [];

        foreach ($data as $item) {
            $collection[] = static::formatItem($item);
        }

        return $collection;
    }
}
