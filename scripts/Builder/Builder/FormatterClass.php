<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Script\Builder\Builder;

use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Param;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\Ternary;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Return_;
use Velkuns\ArtifactsMMO\Script\Builder\BuilderInterface;
use Velkuns\ArtifactsMMO\Script\Builder\Traits\HelperTrait;

class FormatterClass extends Class_
{
    use HelperTrait;

    private BuilderInterface|null $builder = null;

    public function __construct(string $name, private readonly Schema $schema)
    {
        parent::__construct($name);
    }

    public function setBuilder(BuilderInterface $builder): static
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @param string[] $interfaces
     */
    public function setPhpDocWithGeneric(string $voType, array $interfaces): self
    {
        $phpdoc = ['/**'];
        if (isset($interfaces['FormatterInterface'])) {
            $phpdoc[] = " * @implements FormatterInterface<$voType>";
        }

        if (isset($interfaces['ListFormatterInterface'])) {
            $phpdoc[] = " * @implements ListFormatterInterface<$voType>";
        }

        $phpdoc[] = ' */';

        $this->setDocComment(new Doc(\implode("\n", $phpdoc)));

        return $this;
    }

    public function addFormatItemMethod(string $voType): self
    {
        $factory = new BuilderFactory();

        $method = $factory->method('formatItem')
            ->makeStatic()
            ->makePublic()
            ->addParams([$factory->param('data')->setType('\stdClass')])
            ->setReturnType($voType)
            ->setDocComment(new Doc(''))
        ;


        $args = $this->buildConstructorArgs($this->schema);
        $method->addStmt(new Return_(new New_(new Name($voType), $args)));

        $this->addStmt($method);

        return $this;
    }

    /**
     * @return Arg[]
     */
    private function buildConstructorArgs(Schema $schema): array
    {
        $factory = new BuilderFactory();
        $params  = [];
        $phpdoc  = [];

        $required = $schema->required ?? [];
        foreach ($schema->properties as $name => $property) {
            if ($property instanceof Reference) {
                throw new \UnexpectedValueException('Cannot handle Reference type, only Schema type is supported!');
            }

            [$typeReal, $type] = $this->getDeepPropertyType($property, true, $name, $required, $phpdoc, false, $this->builder);

            // Remove null| prefix, not needed here
            $notNullType = \str_starts_with($type, 'null|') ? \substr($type, 5) : $type;
            $isNullable  = !\in_array($name, $required, true);
            $nullable    = $isNullable ? ' ?? null' : '';

            if (\str_ends_with((string) $typeReal, 'array') && !\in_array($type, ['string', 'int', 'float', 'bool'], true)) {
                $dataVar    = new Variable("data->$name" . ($isNullable ? ' ?? []' : ''));
                $expression = $factory->staticCall("{$notNullType}Formatter", 'formatItemList', [$dataVar]);
            } elseif ($typeReal !== $type && !\in_array($notNullType, ['string', 'int', 'float', 'bool'], true)) {
                $dataVar    = new Variable("data->$name");
                $callMethod = $factory->staticCall("{$notNullType}Formatter", 'formatItem', [$dataVar]);
                if ($isNullable) {
                    $expression = new Ternary(new Isset_([$dataVar]), $callMethod, $factory->val(null));
                } else {
                    $expression = $callMethod;
                }
            } else {
                $expression = new Variable("data->$name" . $nullable);
            }

            $params[] = new Arg($expression);
        }

        return $params;
    }
}
