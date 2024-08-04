<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Formatter\FormatterInterface;
use Velkuns\ArtifactsMMO\Formatter\ListFormatterInterface;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Exception code range used: 1100-1109
 */
abstract class AbstractClient
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly LoggerInterface $logger,
        private readonly RequestBuilder $requestBuilder,
    ) {}

    /**
     * @throws ArtifactsMMOClientException
     */
    final protected function fetch(RequestInterface $request): mixed
    {
        $decodedData = null;
        $code        = 0;
        $message     = '';

        try {
            $response = $this->client->sendRequest($request);

            $data = $response->getBody()->getContents();

            if (!empty($data)) {
                $decodedData = \json_decode($data, flags: JSON_THROW_ON_ERROR);
            }

            if ($response->getStatusCode() >= 400) {
                $code    = $this->getErrorCode($decodedData, $response);
                $message = $this->getErrorMessage($decodedData, $response, $code);
                throw new ArtifactsMMOClientException($message, $code);
            }
        } catch (ArtifactsMMOClientException $exception) {
            throw new ArtifactsMMOClientException($message, $code, $exception);
        } catch (\JsonException $exception) {
            throw new ArtifactsMMOClientException('[CLI-1101] Unable to decode json response!', 1101, $exception);
        } catch (ClientExceptionInterface $exception) {
            throw new ArtifactsMMOClientException('[CLI-1100] ' . $exception->getMessage(), 1100, $exception);
        } finally {
            if (!empty($exception) && $exception instanceof \Exception && $exception->getCode() !== 1104) {
                $this->getLogger()->notice($exception->getMessage(), [
                    'type'      => 'component.bachslash.client.fetch',
                    'exception' => $exception,
                ]);
            }
        }

        return $decodedData;
    }

    /**
     * @template TEntity
     * @phpstan-param FormatterInterface<TEntity> $formatter
     * @return TEntity
     * @throws ArtifactsMMOClientException|ClientExceptionInterface
     */
    final protected function fetchVO(RequestInterface $request, FormatterInterface $formatter)
    {
        $decodedData = $this->fetch($request);

        $this->assertIsStdClass($decodedData);
        return $formatter->format($decodedData);
    }

    /**
     * @template TEntity
     * @phpstan-param ListFormatterInterface<TEntity> $formatter
     * @return TEntity[]
     * @throws ArtifactsMMOClientException|ClientExceptionInterface
     */
    final protected function fetchVOList(RequestInterface $request, ListFormatterInterface $formatter): array
    {
        $decodedData = $this->fetch($request);

        $this->assertIsStdClass($decodedData);
        return $formatter->formatList($decodedData);
    }

    final protected function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    final protected function getRequestBuilder(): RequestBuilder
    {
        return $this->requestBuilder;
    }

    /** @phpstan-assert \stdClass $decodedData */
    private function assertIsStdClass(mixed $decodedData): void
    {
        if (!($decodedData instanceof \stdClass)) {
            throw new ArtifactsMMOClientException('Decoded data is not a \stdClass instance!', 1105);
        }
    }

    /**
     * @param mixed $data
     * @param ResponseInterface|null $response
     * @return int
     */
    private function getErrorCode(mixed $data, ?ResponseInterface $response): int
    {
        $code = 1102;

        if ($data instanceof \stdClass && !empty($data->error)) {
            $code = !empty($data->error->code) ? $data->error->code : 1104;
        } elseif ($response !== null && $response->getStatusCode() >= 400) {
            $code = 1103;
        }

        return (int) $code;
    }

    /**
     * @param mixed $data
     * @param ResponseInterface $response
     * @param int $internalCode
     * @return string
     */
    private function getErrorMessage(
        mixed $data,
        ResponseInterface $response,
        int $internalCode,
    ): string {
        $error = $data instanceof \stdClass && !empty($data->error) ? $data->error : null;

        $prefix = '[CLI-' . $internalCode . '] ';

        //~ Override default prefix
        if (!empty($error->code)) {
            $prefix = '[API-' . $error->code . '] ';
        } elseif ($response->getStatusCode() >= 400) {
            $prefix = '[HTTP-' . $response->getStatusCode() . '] ';
        }

        if (is_string($data)) {
            $message = $data;
        } else {
            $message = $error->message ?? 'An error as occurred!';
        }

        return $prefix . $message;
    }
}
