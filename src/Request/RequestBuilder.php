<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Request;

use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

class RequestBuilder
{
    public function __construct(
        private readonly RequestFactoryInterface $requestFactory,
        private readonly UriFactoryInterface $uriFactory,
        private readonly ArtifactsMMOConfig $config,
    ) {}


    /**
     * @param string $endpoint
     * @param array<string, int|int[]|float|string|string[]> $params
     * @param string $method
     * @return RequestInterface
     * @throws ArtifactsMMOComponentException
     * @throws \JsonException
     */
    public function build(string $endpoint = '/ping', array $params = [], string $method = 'GET'): RequestInterface
    {
        if (empty($endpoint)) {
            throw new ArtifactsMMOComponentException('Empty endpoint', 1200);
        }

        $query = '';
        if ($method === 'GET' && !empty($params)) {
            $query = \http_build_query($params);
        }

        $uri     = $this->createUri($endpoint, $query);
        $request = $this->createRequest($uri, $method);

        if ($method !== 'GET' && !empty($params)) {
            $request->getBody()->write(\json_encode($params, flags: JSON_THROW_ON_ERROR));
        }

        return $request;
    }

    /**
     * @param string $endpoint
     * @param string $query
     * @return UriInterface
     */
    private function createUri(string $endpoint, string $query = ''): UriInterface
    {
        return $this->uriFactory->createUri()
            ->withScheme($this->config->scheme)
            ->withHost($this->config->host)
            ->withPath($endpoint)
            ->withQuery($query)
        ;
    }

    /**
     * @param UriInterface $uri
     * @param string $method
     * @return RequestInterface
     */
    private function createRequest(UriInterface $uri, string $method): RequestInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri);

        return $request
            ->withAddedHeader('Authorization', 'Bearer  ' . $this->config->token)
            ->withAddedHeader('Content-Type', 'application/json')
            ->withAddedHeader('Accept', 'application/json')
        ;
    }
}
