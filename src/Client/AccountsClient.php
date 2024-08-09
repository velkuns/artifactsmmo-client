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
}
