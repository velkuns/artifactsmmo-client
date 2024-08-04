<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Generator;

use cebe\openapi\spec\PathItem;
use PhpParser\BuilderFactory;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\DeclareDeclare;
use PhpParser\PrettyPrinter\Standard;

class ClientGenerator
{
    public function __construct(
        private readonly BuilderFactory $factory,
    ) {}

    public function generate(string $path, PathItem $pathItem): void
    {
        [$name] = \explode('/', \trim($path, '/'), 2);
        $name   = \ucfirst($name);

        $methodName = \str_replace(' ', '', \ucwords(\strtolower($pathItem->post->summary)));
        //$methodName

        $declare = new Declare_([new DeclareDeclare('strict_types', new LNumber(1))]);
        $node = $this->factory
            ->namespace('Velkuns\ArtifactsMMO\Client')
            ->addStmt(
                $this->factory
                ->class("{$name}Client")
                ->extend('AbstractClient')
                ->addStmt(
                    $this->factory
                    ->method($methodName)
                    ->makePublic()
                )
            )
            ->getNode()
        ;


        $prettyPrinter = new Standard();
        echo $prettyPrinter->prettyPrintFile([$declare, $node]);
    }
}
