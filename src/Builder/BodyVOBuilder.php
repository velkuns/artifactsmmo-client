<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder;

use cebe\openapi\spec\Schema;
use PhpParser\Builder\Class_;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\DeclareDeclare;
use Velkuns\ArtifactsMMO\Builder\Builder\VOClass;
use Velkuns\ArtifactsMMO\Builder\Printer\CustomStandard;
use Velkuns\ArtifactsMMO\Builder\Traits\HelperTrait;

class BodyVOBuilder implements BuilderInterface
{
    use HelperTrait;

    /** @var Class_[] */
    private array $vos = [];

    public function __construct(
        private readonly BuilderFactory $factory,
    ) {}

    public function generate(): void
    {
        $prettyPrinter = new CustomStandard(['shortArraySyntax' => true, 'arrayMultiline' => true, 'methodMultiline' => true]);
        $declare       = new Declare_([new DeclareDeclare('strict_types', new LNumber(1))]);

        foreach ($this->vos as $className => $class) {
            $namespace = $this->factory
                ->namespace('Velkuns\ArtifactsMMO\VO\Body')
                ->addStmt($this->factory->use('Eureka\Component\Serializer\JsonSerializableTrait'))
                ->addStmt($this->factory->use('JsonSerializable'))
                ->setDocComment(new Doc(''))
                ->addStmt($class);
            $content   = $prettyPrinter->prettyPrintFile([$declare, $namespace->getNode()]);
            \file_put_contents(__DIR__ . "/../../src/VO/Body/$className.php", $content);
        }
    }

    public function add(Schema $schema, string $return, string $realType = ''): void
    {
        if (isset($this->vos[$return])) {
            return;
        }

        $this->vos[$return] = (new VOClass($return))
            ->implement('JsonSerializable')
            ->addStmt($this->factory->useTrait('JsonSerializableTrait'))
            ->setDocComment(new Doc(''))
            ->addConstructor($schema)
            ->addJsonSerializeMethod($schema)
        ;
    }
}
