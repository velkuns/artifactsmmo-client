<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\NullLogger;
use Velkuns\ArtifactsMMO\Client\Client;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException;
use Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException;
use Velkuns\ArtifactsMMO\VO\Status;

class ClientTest extends TestCase
{
    use Helper\ConfigTrait;
    use Helper\ClientTrait;

    /**
     * @throws ArtifactsMMOComponentException
     * @throws ClientExceptionInterface
     * @throws ArtifactsMMOClientException
     * @throws \JsonException
     */
    public function testICanGetStatus(): void
    {
        $status = $this->getClient()->getStatus();

        $this->assertInstanceOf(Status::class, $status, var_export($status, true));

        $this->assertSame('online', $status->status);
    }

    private function getClient(): Client
    {
        return new Client(
            self::getHttpClient(),
            new NullLogger(),
            self::getRequestBuilder(self::getConfig()),
        );
    }
}
