<?php

declare (strict_types=1);

namespace Velkuns\ArtifactsMMO\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\Formatter;
use Velkuns\ArtifactsMMO\VO;
use JsonException;

class CharactersClient extends AbstractClient
{
    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function createCharacter(VO\Body\BodyAddCharacter $body): VO\Character
    {
        $endpoint = '/characters/create';
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function deleteCharacter(VO\Body\BodyDeleteCharacter $body): VO\Character
    {
        $endpoint = '/characters/delete';
        $request = $this->getRequestBuilder()->build($endpoint, body: $body->jsonSerialize(), method: 'POST');
        return $this->fetchVO($request, new Formatter\CharacterFormatter());
    }

    /**
     * @param array{sort?:string, page?:int, size?:int} $query
     * @return VO\Character[]
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getAllCharacters(array $query = []): array
    {
        $endpoint = '/characters/';
        $request = $this->getRequestBuilder()->build($endpoint, query: $query, method: 'GET');
        return $this->fetchVOList($request, new Formatter\CharacterFormatter());
    }

    /**
     * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException
     */
    public function getCharacter(string $name): VO\Character
    {
        $endpoint = "/characters/$name";
        $request = $this->getRequestBuilder()->build($endpoint, method: 'GET');
        return $this->fetchVO($request, new Formatter\CharacterFormatter());
    }
}
