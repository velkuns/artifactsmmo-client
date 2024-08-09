<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class MapsClient extends AbstractClient
{
    /**
     * @param array{content_type?:string, content_code?:string, page?:int, size?:int} $query
     * @return VO\Map[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllMaps(array $query = []): array
    {
        $endpoint = '/maps/';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\MapFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getMap(int $x, int $y): VO\Map
    {
        $endpoint = '/maps/{x}/{y}';
        $replace = ['{x}' => $x, '{y}' => $y];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\MapFormatter());
    }
}
