<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class AccountsClient extends AbstractClient
{
    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function createAccount(VO\Body\BodyAddAccount $body): VO\Response
    {
        $endpoint = '/accounts/create';
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\ResponseFormatter());
    }

    /**
     * @param array{type?:string, completed?:bool, page?:int, size?:int} $query
     * @return VO\AccountAchievement[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAccountAchievements(string $account, array $query = []): array
    {
        $endpoint = "/accounts/$account/achievements";
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\AccountAchievementFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAccount(string $account): VO\AccountDetails
    {
        $endpoint = "/accounts/$account";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\AccountDetailsFormatter());
    }
}
