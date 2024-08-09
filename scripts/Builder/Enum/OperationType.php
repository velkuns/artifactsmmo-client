<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Script\Builder\Enum;

enum OperationType: string
{
    case Get = 'get';
    case Put = 'put';
    case Post = 'post';
    case Delete = 'delete';
    case Options = 'options';
    case Head = 'head';
    case Patch = 'patch';
    case Trace = 'trace';
}
