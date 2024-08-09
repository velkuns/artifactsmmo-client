<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder\Builder;

use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Param;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Stmt\Return_;
use Velkuns\ArtifactsMMO\Builder\BuilderInterface;
use Velkuns\ArtifactsMMO\Builder\Traits\HelperTrait;
use Velkuns\ArtifactsMMO\Builder\VOBuilder;

class VOClass extends Class_
{
    use HelperTrait;

    private BuilderInterface|null $builder = null;

    public function setBuilder(BuilderInterface $builder): static
    {
        $this->builder = $builder;

        return $this;
    }

    public function addConstructor(Schema $schema): static
    {
        $factory = new BuilderFactory();

        [$params, $phpdoc] = $this->buildConstructorParams($schema);

        $method = $factory
            ->method('__construct')
            ->makePublic()
            ->addParams($params)
        ;

        if (!empty($phpdoc)) {
            array_unshift($phpdoc, '/**');
            $phpdoc[] = ' */';
            $method->setDocComment(new Doc(\implode("\n", $phpdoc)));
        } else {
            $method->setDocComment(new Doc(''));
        }

        $this->addStmt($method);

        return $this;
    }

    public function addJsonSerializeMethod(Schema $schema): static
    {
        $factory = new BuilderFactory();

        $method = $factory
            ->method('jsonSerialize')
            ->makePublic()
            ->setReturnType('array')
        ;

        $phpdoc     = [];
        $arrayItems = [];
        $required   = $schema->required ?? [];

        foreach ($schema->properties as $name => $property) {
            if ($property instanceof Reference) {
                throw new \UnexpectedValueException('Cannot handle Reference type, only Schema type is supported!');
            }

            $isRequired   = \in_array($name, $required, true);
            $propertyName = $this->camelize($name);

            [$typeReal, $type] = $this->getDeepPropertyType($property, $isRequired, $name, $required, $phpdoc, false, $this->builder);

            $arrayItem    = new ArrayItem($factory->var("this->$propertyName"), $factory->val($propertyName));
            $arrayItems[] = $arrayItem;
            $phpdoc[]     = "$propertyName: $type" . (str_ends_with((string) $typeReal, 'array') ? '[]' : '');
        }

        $method->addStmt(new Return_(new Array_($arrayItems)));
        $method->setDocComment(
            new Doc("\n/**\n * @return array{\n *     " . implode(",\n *     ", $phpdoc) . ",\n * }\n */"),
        );

        $this->addStmt($method);

        return $this;
    }

    /**
     * @return array{0: Param[], 1: string[]}
     */
    private function buildConstructorParams(Schema $schema): array
    {
        $factory = new BuilderFactory();
        $params  = [];
        $phpdoc  = [];

        $required = $schema->required ?? [];
        foreach ($schema->properties as $name => $property) {
            if ($property instanceof Reference) {
                throw new \UnexpectedValueException('Cannot handle Reference type, only Schema type is supported!');
            }

            $isRequired   = \in_array($name, $required, true);
            $propertyName = $this->camelize($name);

            [$typeReal, $type] = $this->getDeepPropertyType($property, $isRequired, $name, $required, $phpdoc, true, $this->builder);

            $param = $factory->param($propertyName)
                ->setType($typeReal !== $type && $typeReal !== null ? $typeReal : $type)
                ->makePublic()
                ->makeReadonly()
            ;

            if (isset($property->default) && \is_scalar($property->default)) {
                $param->setDefault($factory->val($property->default));
            }

            $params[] = $param;
        }

        return [$params, $phpdoc];
    }
}
