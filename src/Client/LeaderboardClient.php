<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class LeaderboardClient extends AbstractClient
{
    /**
     * @param array{sort?:string, page?:int, size?:int} $query
     * @return VO\CharacterLeaderboard[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getLeaderboard(array $query = []): array
    {
        $endpoint = '/leaderboard';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\CharacterLeaderboardFormatter());
    }
}
