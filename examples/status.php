<?php

declare(strict_types=1);

namespace Application;

use Eureka\Component\Curl\HttpClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Log\NullLogger;
use Velkuns\ArtifactsMMO\Client\Client;
use Velkuns\ArtifactsMMO\Config\ArtifactsMMOConfig;
use Velkuns\ArtifactsMMO\Request\RequestBuilder;

require_once(__DIR__ . '/../vendor/autoload.php');

$token = ''; // Your token

//~ Config part
$config = new ArtifactsMMOConfig('api.artifactsmmo.com', 'https', $token);

//~ Client dependencies
$httpClient     = new HttpClient(userAgent: 'artifactsmmo-client-test/1.0');
$requestFactory = new Psr17Factory();
$uriFactory     = new Psr17Factory();
$requestBuilder = new RequestBuilder($requestFactory, $uriFactory, $config);
$logger         = new NullLogger();

//~ Client
$client = new Client($httpClient, $logger, $requestBuilder);

$status = $client->getStatus(); // Get status (VO\Status);

echo "Server is $status->status\n";
echo "Number of characters online: $status->charactersOnline\n";
