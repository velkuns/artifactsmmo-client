<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Tests\Unit\Client;

use Velkuns\ArtifactsMMO\Client\AbstractClient;
use Velkuns\ArtifactsMMO\Exception\Api\CooldownException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOApiException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Formatter\FormatterInterface;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\NullLogger;

/**
 * Class CommonClientTest
 *
 * @author Romain Cottard
 */
class CommonClientTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionIsThrownWhenApiReturnAnErrorResponseWithoutAnErrorContent(): void
    {
        $mockClient = $this->getMockClient(400);

        $this->expectExceptionCode(1103);
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }
    /**
     * @throws Exception
     */
    public function testArtifactsMMOApiExceptionIsThrownWhenApiReturnAnErrorCode409(): void
    {
        $mockClient = $this->getMockClient(499, '{"error":{"message": "Character in cooldown.","code": 499}}');

        $this->expectExceptionCode(499);
        $this->expectException(CooldownException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionIsThrownWhenApiReturnAnErrorResponseWithAnErrorContent(): void
    {
        $mockClient = $this->getMockClient(503, '{"error":{"message": "Service Unavailable","status": "503"}}');

        $this->expectExceptionCode(1104);
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionIsThrownWhenApiAnInvalidJsonResponse(): void
    {
        $mockClient = $this->getMockClient(200, '[}');

        $this->expectExceptionCode(1101);
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionWithSpecificExceptionCodeIsThrownWhenApiReturnAnErrorResponseWithAnErrorContentThatContainCodeError(): void
    {
        $mockClient = $this->getMockClient(503, '{"error":{"message": "Service Unavailable","status": "503","code": "123456"}}');

        $this->expectExceptionCode(123456);
        $this->expectExceptionMessage('[API-123456] Service Unavailable');
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionWithSpecificExceptionMessageIsThrownWhenApiReturnAnErrorResponseWithAnErrorContentThatContainCodeError(): void
    {
        $mockClient = $this->getMockClient(503, '"Something is broken!"');

        $this->expectExceptionCode(1103);
        $this->expectExceptionMessage('[HTTP-503] Something is broken!');
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionWithCode9100IsThrownWhenHttpClientThrowAnException(): void
    {
        $mockClient = $this->getMockClient(200, '', new class ('Timeout', 29) extends \Exception implements ClientExceptionInterface {});

        $this->expectExceptionCode(1100);
        $this->expectExceptionMessage('Timeout');
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @throws Exception
     */
    public function testArtifactsMMOClientExceptionIsThrownWhenNonObjectResponseIsReturnedForAnHttpCode200(): void
    {
        $mockClient = $this->getMockClient(200, '"A string as response for 200 Http code"');

        $this->expectExceptionCode(1105);
        $this->expectExceptionMessage('Decoded data is not a \stdClass instance!');
        $this->expectException(ArtifactsMMOClientException::class);
        $mockClient->getEndpoint();
    }

    /**
     * @param int $httpCode
     * @param string $content
     * @param ClientExceptionInterface|null $exception
     * @return AbstractClient&object
     * @throws Exception
     */
    private function getMockClient(int $httpCode, string $content = '', ?ClientExceptionInterface $exception = null)
    {
        $httpClient     = $this->getMockHttpClient($httpCode, $content, $exception);
        $logger         = new NullLogger();
        $requestBuilder = $this->createMock(RequestBuilder::class);

        return new class ($httpClient, $logger, $requestBuilder) extends AbstractClient {
            /**
             * @return int|array<mixed>|mixed|string|null
             */
            public function getEndpoint(): mixed
            {
                $request = $this->getRequestBuilder()->build('/mock-endpoint');

                return $this->fetchVO($request, new class implements FormatterInterface {
                    /**
                     * @param \stdClass $data
                     * @return mixed
                     */
                    public function format(\stdClass $data)
                    {
                        return $data;
                    }
                });
            }
        };
    }

    /**
     * @throws Exception
     */
    private function getMockHttpClient(int $httpCode, string $content = '', ?ClientExceptionInterface $exception = null): ClientInterface
    {
        $response = (new Psr17Factory())->createResponse($httpCode);

        if (!empty($content)) {
            $response->getBody()->write($content);
            $response->getBody()->rewind();
        }

        $httpClientMock = $this->createMock(ClientInterface::class);
        $httpClientMock
            ->method('sendRequest')
            ->willReturn($response)
        ;

        if ($exception !== null) {
            $httpClientMock
                ->method('sendRequest')
                ->willThrowException($exception)
            ;
        }

        return $httpClientMock;
    }
}
