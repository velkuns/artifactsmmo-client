<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Script\Builder;

use cebe\openapi\spec\Schema;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\DeclareDeclare;
use PhpParser\Node\Stmt\TraitUse;
use Velkuns\ArtifactsMMO\Script\Builder\Builder\FormatterClass;
use Velkuns\ArtifactsMMO\Script\Builder\Printer\CustomStandard;
use Velkuns\ArtifactsMMO\Script\Builder\Traits\HelperTrait;

class FormatterBuilder implements BuilderInterface
{
    use HelperTrait;

    /** @var FormatterClass[] */
    private array $formatters = [];

    /** @var string[][] */
    private array $formattersImplements = [];

    public function __construct(
        private readonly BuilderFactory $factory,
    ) {}

    public function generate(): void
    {
        $prettyPrinter = new CustomStandard(['shortArraySyntax' => true, 'newMultiline' => true]);
        $declare       = new Declare_([new DeclareDeclare('strict_types', new LNumber(1))]);

        foreach ($this->formatters as $className => $class) {
            $voType = 'VO\\' . \str_replace('Formatter', '', $className);
            $class
                ->implement(...$this->formattersImplements[$className])
                ->setPhpDocWithGeneric($voType, $this->formattersImplements[$className])
            ;

            $namespace = $this->factory
                ->namespace('Velkuns\ArtifactsMMO\Formatter')
                ->addStmt($this->factory->use('Velkuns\ArtifactsMMO\VO'))
                ->setDocComment(new Doc(''))
                ->addStmt($class)
            ;

            $content   = $prettyPrinter->prettyPrintFile([$declare, $namespace->getNode()]);
            \file_put_contents(__DIR__ . "/../../src/Formatter/$className.php", $content);
        }
    }

    public function add(Schema $schema, string $return, string $realType = ''): void
    {
        $className = "{$return}Formatter";
        if (!isset($this->formatters[$className])) {
            $class = (new FormatterClass($className, $schema))->setBuilder($this);
            $class = $this->generateMethods($class, $className);

            $this->formatters[$className] = $class;
        }

        $implements = $realType === 'array' ? 'ListFormatterInterface' : 'FormatterInterface';
        $this->formattersImplements[$className][$implements] = $implements;
    }

    private function generateMethods(FormatterClass $class, string $className): FormatterClass
    {
        $voType = 'VO\\' . \str_replace('Formatter', '', $className);

        $trait = new TraitUse([new Name('FormatterTrait')]);
        $trait->setDocComment(new Doc("/** @use FormatterTrait<$voType> */"));

        $class
            ->addStmt($trait)
            ->addFormatItemMethod($voType)
        ;

        return $class;
    }
}
