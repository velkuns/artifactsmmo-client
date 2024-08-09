<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Tests\Unit\Request;

use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class BachslashRequestBuilderTest
 *
 * @author Pierre-Olivier Dézard
 */
class RequestBuilderTest extends TestCase
{
    private RequestBuilder $requestBuilder;

    /**
     * @return void
     * @throws ArtifactsMMOComponentException
     * @throws \JsonException
     */
    public function testICanBuildPingRequest(): void
    {
        $request = $this->requestBuilder->build();

        $this->assertEquals('https://example.com/ping', (string) $request->getUri());
    }

    /**
     * @return void
     * @throws ArtifactsMMOComponentException
     * @throws \JsonException
     */
    public function testICanBuildSimpleGetRequestWithParams(): void
    {
        $request = $this->requestBuilder->build('/user/curator/198225115', ['filter' => 0]);

        $this->assertEquals('https://example.com/user/curator/198225115?filter=0', (string) $request->getUri());
    }

    /**
     * @return void
     * @throws ArtifactsMMOComponentException
     * @throws \JsonException
     */
    public function testICanBuildSimplePostRequestWithParams(): void
    {
        $request = $this->requestBuilder->build('/user/curator/198225115', ['filter' => 0], method: 'POST');

        $this->assertEquals('https://example.com/user/curator/198225115', (string) $request->getUri());
        $this->assertEquals('{"filter":0}', (string) $request->getBody());
    }

    /**
     * @return void
     * @throws ArtifactsMMOComponentException
     * @throws \JsonException
     */
    public function testAnExceptionIsThrownWhenISetAnEmptyEndpoint(): void
    {
        $this->expectException(ArtifactsMMOComponentException::class);

        $this->requestBuilder->build('', ['filter' => 0], method: 'POST');
    }

    /**
     * @return void
     */
    public function setUp(): void
    {
        $httpFactory = new Psr17Factory();

        //~ Builder
        $this->requestBuilder = new RequestBuilder(
            $httpFactory,
            $httpFactory,
            new ArtifactsMMOConfig('example.com', 'https', 'blabla'),
        );
    }
}
