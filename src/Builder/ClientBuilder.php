<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Parameter;
use cebe\openapi\spec\PathItem;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Response;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Param;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\DeclareDeclare;
use Velkuns\ArtifactsMMO\Builder\Builder\ClientMethod;
use Velkuns\ArtifactsMMO\Builder\Enum\OperationType;
use Velkuns\ArtifactsMMO\Builder\Printer\CustomStandard;

class ClientBuilder
{
    /** @var Class_[] */
    private array $classes = [];

    public function __construct(
        private readonly BuilderFactory $factory,
    ) {}

    public function generate(): void
    {
        $prettyPrinter = new CustomStandard(['shortArraySyntax' => true]);
        $declare       = new Declare_([new DeclareDeclare('strict_types', new LNumber(1))]);

        foreach ($this->classes as $className => $class) {
            $namespace = $this->factory
                ->namespace('Velkuns\ArtifactsMMO\Client')
                ->setDocComment(new Doc(''))
                ->addStmt($this->factory->use('Psr\Http\Client\ClientExceptionInterface'))
                ->addStmt($this->factory->use('Velkuns\ArtifactsMMO\Exception\ArtifactsMMOClientException'))
                ->addStmt($this->factory->use('Velkuns\ArtifactsMMO\Exception\ArtifactsMMOComponentException'))
                ->addStmt($this->factory->use('Velkuns\ArtifactsMMO\Formatter'))
                ->addStmt($this->factory->use('Velkuns\ArtifactsMMO\VO'))
                ->addStmt($this->factory->use('JsonException'))
                ->addStmt($class);
            $content   = $prettyPrinter->prettyPrintFile([$declare, $namespace->getNode()]);
            \file_put_contents(__DIR__ . "/../../src/Client/$className.php", $content);
        }

    }

    public function add(string $path, PathItem $pathItem): void
    {
        [$name] = \explode('/', \trim($path, '/'), 2);
        $name   = \ucfirst($name);

        if (!isset($this->classes["{$name}Client"])) {
            $class = $this->factory->class("{$name}Client")
                ->extend('AbstractClient')
                ->setDocComment(new Doc(''))
            ;
        } else {
            $class = $this->classes["{$name}Client"];
        }

        foreach (OperationType::cases() as $operationType) {
            if (empty($pathItem->{$operationType->value})) {
                continue;
            }

            $operation = $pathItem->{$operationType->value};
            $class->addStmt($this->generateMethod($path, $operation, $operationType));
        }

        $this->classes["{$name}Client"] = $class;
    }

    private function generateMethod(string $path, Operation $operation, OperationType $operationType): ClientMethod
    {
        $methodName  = \lcfirst(\str_replace(' ', '', \ucwords(\strtolower($operation->summary))));

        $pathParams  = $this->generatePathParams($operation);
        $bodyParams  = $this->generateBodyParams($operation);
        $queryParams = $this->generateQueryParams($operation);

        $returnType = $this->getReturnType($operation);
        $phpdoc     = $this->getPhpdocTypedArray($operation, $returnType);

        $type = $returnType['realType'] !== 'array' ? "VO\\{$returnType['realType']}" : $returnType['realType'];

        return (new ClientMethod($methodName))
            ->makePublic()
            ->addParams([...$pathParams, ...$bodyParams, ...$queryParams])
            ->setReturnType($type)
            ->setDocComment($phpdoc)
            //~ Specific client methods
            ->addAssignEndpoint($path, $this->filterPathParams($operation))
            ->addCallBuilder(!empty($queryParams), !empty($bodyParams), $operationType)
            ->addReturnData($returnType)
        ;
    }

    /**
     * @return list<Param>
     */
    private function generatePathParams(Operation $operation): array
    {
        $params = [];

        foreach ($operation->parameters as $param) {
            if ($param instanceof Reference || $param->in !== "path") {
                continue;
            }

            $params[] = $this->factory
                ->param($param->name)
                ->setType($this->getParamType($param))
            ;
        }

        return $params;
    }

    /**
     * @return list<Param>
     */
    private function generateQueryParams(Operation $operation): array
    {
        $queryParams = $this->filterQueryParams($operation);
        if (empty($queryParams)) {
            return [];
        }

        $param = $this->factory
            ->param('query')
            ->setType('array')
            ->setDefault([])
        ;

        return [$param];
    }

    /**
     * @return list<Param>
     */
    private function generateBodyParams(Operation $operation): array
    {
        if (empty($operation->requestBody)) {
            return [];
        }

        if ($operation->requestBody instanceof Reference) {
            throw new \UnexpectedValueException('Reference schema is not currently supported!');

        }

        $body = $operation->requestBody->content['application/json'] ?? null;

        if (empty($body)) {
            return [];
        }

        $bodyType = 'VO\Body\Body' . \str_replace('Schema', '', $body->schema?->title ?? 'Unknown');
        $param = $this->factory
            ->param('body')
            ->setType($bodyType)
        ;

        if (!$operation->requestBody->required) {
            $param->setDefault([]);
        }

        return [$param];
    }

    /**
     * @return list<Parameter>
     */
    private function filterPathParams(Operation $operation): array
    {
        $params = [];

        foreach ($operation->parameters as $param) {
            if ($param instanceof Reference || $param->in !== "path") {
                continue;
            }

            $params[] = $param;
        }

        return $params;
    }

    /**
     * @return list<Parameter>
     */
    private function filterQueryParams(Operation $operation): array
    {
        $params = [];

        foreach ($operation->parameters as $param) {
            if ($param instanceof Reference || $param->in !== "query") {
                continue;
            }

            $params[] = $param;
        }

        return $params;
    }

    /**
     * @param array{realType: string, type: string} $returnType
     */
    private function getPhpdocTypedArray(Operation $operation, array $returnType): Doc
    {
        $phpdoc = [
            'new'    => '',
            'top'    => '/**',
            'query'  => ' * @param array{#ARRAY_TYPES#} $query',
            'return' => ' * @return VO\#RETURN_TYPE#[]',
            'throws' => ' * @throws ArtifactsMMOClientException|ArtifactsMMOComponentException|ClientExceptionInterface|JsonException',
            'end'    => ' */',
        ];

        $params = $this->filterQueryParams($operation);
        if (!empty($params)) {
            $types = [];
            foreach ($params as $param) {
                $types[] = $param->name . (!$param->required ? '?:' : ':') . $this->getParamType($param);
            }

            $arrayTypesQuery = \implode(', ', $types);
            $phpdoc['query'] = \str_replace('#ARRAY_TYPES#', $arrayTypesQuery, $phpdoc['query']);
        } else {
            unset($phpdoc['query']);
        }

        if ($returnType['realType'] !== 'array') {
            unset($phpdoc['return']);
        } else {
            $phpdoc['return'] = \str_replace('#RETURN_TYPE#', $returnType['type'], $phpdoc['return']);
        }

        return new Doc(\implode("\n", $phpdoc));
    }

    /**
     * @return array{realType: string, type: string}
     */
    private function getReturnType(Operation $operation): array
    {
        /** @var Response|null $responseSuccess */
        $responseSuccess = $operation->responses['200'] ?? null;
        if (empty($responseSuccess)) {
            throw new \UnexpectedValueException('No success response, cannot process endpoint !');
        }

        $response = $responseSuccess->content['application/json']->schema;

        $type = $response->properties['data']->type ?? null;
        if ($type === 'array') {
            $schemaName = $response->properties['data']->items->title ?? '';
            $realType   = 'array';
        } else {
            $schemaName = $response->properties['data']->title ?? $response->title ?? null;
        }
        $returnType = \str_replace('Schema', '', (string) $schemaName);

        if (empty($returnType)) {
            throw new \UnexpectedValueException('Return type cannot be empty!');
        }

        return ['realType' => $realType ?? $returnType, 'type' => $returnType];
    }

    private function getParamType(Parameter $param): string
    {
        $type = $param->schema?->type ?? 'string';

        return match($type) {
            'integer' => 'int',
            default   => $type,
        };
    }
}
