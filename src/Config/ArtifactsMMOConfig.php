<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Component\ArtifactsMMO\Config;

use Velkuns\Component\ArtifactsMMO\Exception\ArtifactsMMOConfigException;

class ArtifactsMMOConfig
{
    /**
     * @throws ArtifactsMMOConfigException
     */
    public function __construct(
        public readonly string $host,
        public readonly string $scheme,
        public readonly string $token,
    ) {
        if (empty($this->host)) {
            throw new ArtifactsMMOConfigException('Host server cannot be empty!', 1000);
        }

        if (!in_array(strtolower($this->scheme), ['http', 'https'])) {
            throw new ArtifactsMMOConfigException('Only http/https scheme are supported!', 1001);
        }

        if (empty($this->token)) {
            throw new ArtifactsMMOConfigException('Token cannot be empty', 1002);
        }
    }
}
