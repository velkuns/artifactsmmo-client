<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class GrandexchangeClient extends AbstractClient
{
    /**
     * @param array{seller?:string, buyer?:string, page?:int, size?:int} $query
     * @return VO\GeOrderHistory[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeSellHistory(string $code, array $query = []): array
    {
        $endpoint = "/grandexchange/history/$code";
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\GeOrderHistoryFormatter());
    }

    /**
     * @param array{code?:string, seller?:string, page?:int, size?:int} $query
     * @return VO\GEOrder[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeSellOrders(array $query = []): array
    {
        $endpoint = '/grandexchange/orders';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\GEOrderFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getGeSellOrder(string $id): VO\GEOrder
    {
        $endpoint = "/grandexchange/orders/$id";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\GEOrderFormatter());
    }
}
