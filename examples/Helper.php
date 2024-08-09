<?php

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Examples;

use Eureka\Component\Curl\HttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\NullLogger;
use Velkuns\ArtifactsMMO\Client\CharactersClient;
use Velkuns\ArtifactsMMO\Client\MyClient;
use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;

class Helper
{
    public static function getHttpClient(): ClientInterface
    {
        return new HttpClient(userAgent: 'artifactsmmo-client-test/1.0');
    }

    public static function getRequestFactory(): RequestFactoryInterface
    {
        return new Psr17Factory();
    }

    public static function getUriFactory(): UriFactoryInterface
    {
        return new Psr17Factory();
    }

    public static function getRequestBuilder(ArtifactsMMOConfig $config): RequestBuilder
    {
        return new RequestBuilder(static::getRequestFactory(), static::getUriFactory(), $config);
    }

    public static function getConfig(string $token): ArtifactsMMOConfig
    {
        return new ArtifactsMMOConfig('api.artifactsmmo.com', 'https', $token);
    }

    public static function getCharacterClient(string $token): CharactersClient
    {
        return new CharactersClient(
            self::getHttpClient(),
            new NullLogger(),
            self::getRequestBuilder(self::getConfig($token)),
        );
    }

    public static function getMyClient(string $token): MyClient
    {
        return new MyClient(
            self::getHttpClient(),
            new NullLogger(),
            self::getRequestBuilder(self::getConfig($token)),
        );
    }
}
