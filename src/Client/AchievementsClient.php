<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class AchievementsClient extends AbstractClient
{
    /**
     * @param array{type?:string, page?:int, size?:int} $query
     * @return VO\BaseAchievement[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllAchievements(array $query = []): array
    {
        $endpoint = '/achievements';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\BaseAchievementFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAchievement(string $code): VO\BaseAchievement
    {
        $endpoint = "/achievements/$code";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\BaseAchievementFormatter());
    }
}
