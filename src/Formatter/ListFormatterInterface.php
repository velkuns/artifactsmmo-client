<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Formatter;

/**
 * @template TEntity
 */
interface ListFormatterInterface
{
    /**
     * @phpstan-return TEntity[]
     */
    public function formatList(\stdClass $data): array;
}
