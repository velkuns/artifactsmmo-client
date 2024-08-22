<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Velkuns\ArtifactsMMO\Exception\Api\ActionInProgressException;
use Velkuns\ArtifactsMMO\Exception\Api\BankInsufficientGoldsException;
use Velkuns\ArtifactsMMO\Exception\Api\BankTransactionInProgressException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterAlreadyAtDestinationException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterInsufficientGoldsException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterInventoryIsFullException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterLevelIsInsufficientException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterNotFoundException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterSkillLevelIsInsufficientException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterTaskEmptyException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterTaskInProgressException;
use Velkuns\ArtifactsMMO\Exception\Api\CharacterTaskNotCompleteException;
use Velkuns\ArtifactsMMO\Exception\Api\CooldownException;
use Velkuns\ArtifactsMMO\Exception\Api\ElementNotFoundOnMapException;
use Velkuns\ArtifactsMMO\Exception\Api\GeItemPriceChangeException;
use Velkuns\ArtifactsMMO\Exception\Api\GeNotStockForItemException;
use Velkuns\ArtifactsMMO\Exception\Api\GeTransactionInProgressException;
use Velkuns\ArtifactsMMO\Exception\Api\ItemAlreadyEquippedException;
use Velkuns\ArtifactsMMO\Exception\Api\ItemCannotBeRecycledException;
use Velkuns\ArtifactsMMO\Exception\Api\MissingItemOrInsuffisantQuantityException;
use Velkuns\ArtifactsMMO\Exception\Api\NotFoundException;
use Velkuns\ArtifactsMMO\Exception\Api\SlotException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOApiException;
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
     * @throws ArtifactsMMOApiException
     */
    final protected function fetch(RequestInterface $request, int $retry = 0): mixed
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
                throw $this->handleError($code, $message);
            }
        } catch (BankTransactionInProgressException | GeTransactionInProgressException $exception) {
            if ($retry < 3) {
                $retry++;
                sleep((int) pow($retry, 2)); // sleep for 1s, 4s, 9s
                return $this->fetch($request, $retry);
            }
            throw $exception;
        } catch (ArtifactsMMOApiException $exception) {
            throw $exception;
        } catch (ArtifactsMMOClientException $exception) {
            throw new ArtifactsMMOClientException($message, $code, $exception);
        } catch (\JsonException $exception) {
            throw new ArtifactsMMOClientException('[LIB-1101] Unable to decode json response!', 1101, $exception);
        } catch (ClientExceptionInterface $exception) {
            //~ Handle timeout by retrying after some delay, until 3 time
            if ($exception->getCode() === 28 && $retry < 5) {
                $retry++;
                sleep((int) pow(4, $retry)); // sleep for 4s, 16s, 64s, 256s, 1024s
                return $this->fetch($request, $retry);
            }
            throw new ArtifactsMMOClientException('[LIB-1100] ' . $exception->getMessage(), 1100, $exception);
        } finally {
            if (!empty($exception) && $exception instanceof \Exception && $exception->getCode() !== 1104) {
                $this->getLogger()->notice($exception->getMessage(), [
                    'type'      => 'artifactmmo.client.fetch',
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
     * @throws ArtifactsMMOApiException
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

    /** @phpstan-assert \stdClass $decodedData
     * @throws ArtifactsMMOClientException
     */
    private function assertIsStdClass(mixed $decodedData): void
    {
        if (!($decodedData instanceof \stdClass)) {
            throw new ArtifactsMMOClientException('Decoded data is not a \stdClass instance!', 1105);
        }
    }

    private function handleError(int $code, string $message): ArtifactsMMOApiException
    {
        return match($code) {
            404 => new NotFoundException($message, $code),
            486 => new ActionInProgressException($message, $code),
            460 => new BankInsufficientGoldsException($message, $code),
            461 => new BankTransactionInProgressException($message, $code),
            473 => new ItemCannotBeRecycledException($message, $code),
            478 => new MissingItemOrInsuffisantQuantityException($message, $code),
            480 => new GeNotStockForItemException($message, $code),
            482 => new GeItemPriceChangeException($message, $code),
            483 => new GeTransactionInProgressException($message, $code),
            485 => new ItemAlreadyEquippedException($message, $code),
            487 => new CharacterTaskEmptyException($message, $code),
            488 => new CharacterTaskNotCompleteException($message, $code),
            489 => new CharacterTaskInProgressException($message, $code),
            490 => new CharacterAlreadyAtDestinationException($message, $code),
            491 => new SlotException($message, $code),
            492 => new CharacterInsufficientGoldsException($message, $code),
            493 => new CharacterLevelIsInsufficientException($message, $code),
            496 => new CharacterSkillLevelIsInsufficientException($message, $code),
            497 => new CharacterInventoryIsFullException($message, $code),
            498 => new CharacterNotFoundException($message, $code),
            499 => new CooldownException($message, $code),
            598 => new ElementNotFoundOnMapException($message, $code),
            default => new ArtifactsMMOApiException($message, $code),
        };
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

        if (\is_string($data)) {
            $message = $data;
        } else {
            $message = $error->message ?? 'An error as occurred!';
        }

        return $prefix . $message;
    }
}
