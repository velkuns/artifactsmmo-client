<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class TokenClient extends AbstractClient
{
    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function generateToken(): VO\TokenResponse
    {
        $endpoint = '/token/';
        $request = $this->getRequestBuilder()->build($endpoint, method: 'POST');
        return $this->fetchVO($request, new Formatter\TokenResponseFormatter());
    }
}
