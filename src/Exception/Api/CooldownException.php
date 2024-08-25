<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Exception\Api;

use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOApiException;

/**
 * Code error: 499
 */
class CooldownException extends ArtifactsMMOApiException
{
    private float $cooldown;

    public function __construct(string $message = '', int $code = 0, \Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);

        preg_match('`\[API-499] Character in cooldown: ([0-9.]+) seconds left`', $message, $matches);

        $this->cooldown = (float) ($matches[1] ?? 0.0);
    }

    public function getCooldown(): float
    {
        return $this->cooldown;
    }

    public function getCooldownAsInt(): int
    {
        return (int) \ceil($this->cooldown);
    }
}
