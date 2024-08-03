<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Component\ArtifactsMMO\Tests\Unit\Config;

use Velkuns\Component\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\Component\ArtifactsMMO\Exception\ArtifactsMMOConfigException;
use PHPUnit\Framework\TestCase;

class ArtifactsMMOConfigTest extends TestCase
{
    public function testICanInstantiateArtifactsMMOConfigClass(): void
    {
        $config = new ArtifactsMMOConfig('example.com', 'https', 'blabla');

        $this->assertInstanceOf(ArtifactsMMOConfig::class, $config);
    }

    public function testICanGetHostNameFromConfigInstance(): void
    {
        $config = new ArtifactsMMOConfig('example.com', 'https', 'blabla');

        $this->assertEquals('example.com', $config->host);
    }

    public function testICanGetSchemeFromConfigInstance(): void
    {
        $config = new ArtifactsMMOConfig('example.com', 'https', 'blabla');

        $this->assertEquals('https', $config->scheme);
    }

    public function testICanGetAuthFromConfigInstance(): void
    {
        $config = new ArtifactsMMOConfig('example.com', 'https', 'blabla');

        $this->assertEquals('blabla', $config->token);
    }

    public function testAnExceptionIsThrownWhenISetAnEmptyHost(): void
    {
        $this->expectExceptionCode(1000);
        $this->expectException(ArtifactsMMOConfigException::class);

        new ArtifactsMMOConfig('', 'https', 'blabla');
    }

    public function testAnExceptionIsThrownWhenISetAnEmptyScheme(): void
    {
        $this->expectExceptionCode(1001);
        $this->expectException(ArtifactsMMOConfigException::class);

        new ArtifactsMMOConfig('example.com', '', 'blabla');
    }

    public function testAnExceptionIsThrownWhenISetAnEmptyUser(): void
    {
        $this->expectExceptionCode(1002);
        $this->expectException(ArtifactsMMOConfigException::class);

        new ArtifactsMMOConfig('example.com', 'https', '');
    }
}
