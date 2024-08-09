<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Tests\Integration\Helper;

use Eureka\Component\Curl\HttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;

trait ClientTrait
{
    private static function getHttpClient(): ClientInterface
    {
        return new HttpClient(userAgent: 'artifactsmmo-client-test/1.0');
    }

    private static function getRequestFactory(): RequestFactoryInterface
    {
        return new Psr17Factory();
    }

    private static function getUriFactory(): UriFactoryInterface
    {
        return new Psr17Factory();
    }

    private static function getRequestBuilder(ArtifactsMMOConfig $config): RequestBuilder
    {
        return new RequestBuilder(self::getRequestFactory(), self::getUriFactory(), $config);
    }
}
