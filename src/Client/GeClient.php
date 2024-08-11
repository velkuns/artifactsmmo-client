<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class GeClient extends AbstractClient
{
    /**
     * @param array{page?:int, size?:int} $query
     * @return VO\GEItem[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllGeItems(array $query = []): array
    {
        $endpoint = '/ge/';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\GEItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeItem(string $code): VO\GEItem
    {
        $endpoint = "/ge/$code";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\GEItemFormatter());
    }
}
