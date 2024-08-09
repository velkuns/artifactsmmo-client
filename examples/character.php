<?php

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Examples;

use Velkuns\ArtifactsMMO\VO\Body\BodyDestination;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Helper.php');

$name  = ''; // Character name
$token = ''; // Your token

$myClient  = Helper::getMyClient($token);
$bankItems = $myClient->getBankItems();
var_export($bankItems);

$characters = $myClient->getMyCharacters();
var_export($characters);

echo "Try to move $name to 0,1: ...";
$response = $myClient->actionMove($name, new BodyDestination(0, 1));
echo "done !\n\n";
var_export($response);
echo "\n";
