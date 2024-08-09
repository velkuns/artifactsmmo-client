<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Tests\Integration\Helper;

use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;

trait ConfigTrait
{
    private function getConfig(): ArtifactsMMOConfig
    {
        $token = getenv('ARTIFACTSMMO_TOKEN') ?: '';

        return new ArtifactsMMOConfig('api.artifactsmmo.com', 'https', $token);
    }
}
