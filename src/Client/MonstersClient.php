<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class MonstersClient extends AbstractClient
{
    /**
     * @param array{min_level?:int, max_level?:int, drop?:string, page?:int, size?:int} $query
     * @return VO\Monster[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllMonsters(array $query = []): array
    {
        $endpoint = '/monsters';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\MonsterFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getMonster(string $code): VO\Monster
    {
        $endpoint = "/monsters/$code";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\MonsterFormatter());
    }
}
