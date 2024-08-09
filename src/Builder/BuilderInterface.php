<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder;

use cebe\openapi\spec\Schema;

interface BuilderInterface
{
    public function generate(): void;

    public function add(Schema $schema, string $return, string $realType = ''): void;
}
