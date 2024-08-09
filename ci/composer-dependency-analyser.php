<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

$config = new Configuration();

return $config
    ->addPathToScan(__DIR__ . '/../src', isDev: false)
    ->addPathToScan(__DIR__ . '/../bin/script', isDev: true)
    ->addPathToScan(__DIR__ . '/../scripts', isDev: true)
    ->addPathToScan(__DIR__ . '/../tests', isDev: true)
;
