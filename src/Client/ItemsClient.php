<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class ItemsClient extends AbstractClient
{
    /**
     * @param array{min_level?:int, max_level?:int, name?:string, type?:string, craft_skill?:string, craft_material?:string, page?:int, size?:int} $query
     * @return VO\Item[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllItems(array $query = []): array
    {
        $endpoint = '/items/';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\ItemFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getItem(string $code): VO\SingleItem
    {
        $endpoint = '/items/{code}';
        $replace = ['{code}' => $code];
        $endpoint = \str_replace(\array_keys($replace), \array_values($replace), $endpoint);
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\SingleItemFormatter());
    }
}
