<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder\Traits;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Response;
use cebe\openapi\spec\Schema;
use Velkuns\ArtifactsMMO\Builder\BuilderInterface;

trait HelperTrait
{
    /**
     * @return array{schema: Reference|Schema|null, type: string, return: string}
     */
    protected function getInfo(Operation $operation): array
    {
        /** @var Response|null $responseSuccess */
        $responseSuccess = $operation->responses['200'] ?? null;
        if (empty($responseSuccess)) {
            throw new \UnexpectedValueException('No success response, cannot process endpoint !');
        }

        $response = $responseSuccess->content['application/json']->schema;

        $type = $response->properties['data']->type ?? '';
        if ($type === 'array') {
            $schemaName = $response->properties['data']->items->title ?? '';
            $schema     = $response->properties['data']->items ?? [];
        } else {
            $schemaName = $response->properties['data']->title ?? $response->title ?? null;
            $schema     = $response->properties['data'] ?? $response ?? null;
        }
        $returnType = \str_replace('Schema', '', (string) $schemaName);

        if (empty($returnType)) {
            throw new \UnexpectedValueException('Return type cannot be empty!');
        }

        return ['schema' => $schema , 'type' => $type, 'return' => $returnType];
    }

    /**
     * @return array{schema: Reference|Schema|null, return: string}
     */
    private function getBodyInfo(Operation $operation): array
    {
        $body = $operation->requestBody->content['application/json']->schema ?? null;

        if (empty($body)) {
            return ['schema' => null, 'return' => ''];
        }

        $return = \str_replace('Schema', '', empty($body->title) ? 'BodyUnknown' : "Body{$body->title}");

        return ['schema' => $body, 'return' => $return];
    }

    protected function getPropertyType(Schema $schema, bool $isRequired): string|null
    {
        $type = $schema->type ?? null;

        if ($type === null) {
            return null;
        }

        $type = match($type) {
            'integer' => 'int',
            'object'  => \str_replace('Schema', '', $schema->title),
            default   => $type,
        };

        if (!$isRequired && !isset($schema->default)) {
            $type = 'null|' . $type;
        }

        return $type;
    }

    /**
     * @param string[] $required
     * @param string[] $phpdoc
     * @return array{0: string|null, 1: string}
     */
    protected function getDeepPropertyType(
        Schema $schema,
        bool $isRequired,
        string $name,
        array $required,
        array &$phpdoc,
        bool $updatePhpdoc,
        BuilderInterface|null $builder,
    ): array {
        $typeReal     = $this->getPropertyType($schema, $isRequired);
        $propertyName = $this->camelize($name);

        if (\str_ends_with((string) $typeReal, 'array') && $schema->items instanceof Schema) {
            $type = $this->handleListItem($schema->items, $name, $propertyName, $required, $phpdoc, $updatePhpdoc, $builder);
        } elseif ($typeReal === null && isset($schema->allOf[0]) && $schema->allOf[0] instanceof Schema) {
            $type = $this->handleAllOf($schema->allOf[0], $builder);
        } elseif ($typeReal === null && !empty($schema->anyOf)) {
            $type = $this->handleAnyOf($schema->anyOf, $builder);
        } elseif ($typeReal === null) {
            //~ Handle bug with schema when property have no type
            $typeReal = 'string';
            $type     = 'string';
        } else {
            $type = $typeReal;
        }

        return [$typeReal, $type];
    }

    /**
     * @param string[] $required
     * @param string[] $phpdoc
     */
    private function handleListItem(
        Schema $schema,
        string $name,
        string $propertyName,
        array $required,
        array &$phpdoc,
        bool $updatePhpdoc,
        BuilderInterface|null $builder,
    ): string {
        $type = $this->getPropertyType($schema, in_array($name, $required, true));
        if ($updatePhpdoc) {
            $phpdoc[] = " * @param {$type}[] \$$propertyName";
        }

        $typeRealNotNull = $this->getPropertyType($schema, true);
        if ($schema->type === 'object') {
            $builder?->add($schema, (string) $typeRealNotNull, (string) $type);
        }

        return (string) $type;
    }

    private function handleAllOf(Schema $schema, BuilderInterface|null $builder): string
    {
        $type = $this->getPropertyType($schema, true);

        $builder?->add($schema, (string) $type, (string) $type);

        return (string) $type;
    }

    /**
     * @param array<Schema|Reference> $anyOf
     */
    private function handleAnyOf(array $anyOf, BuilderInterface|null $builder): string
    {
        $isNullable = false;
        $types      = [];

        foreach ($anyOf as $anySchema) {
            if (!($anySchema instanceof Schema)) {
                continue;
            }

            $typeReal = (string) $this->getPropertyType($anySchema, true);
            if ($typeReal === 'null') {
                $isNullable = true;
                continue;
            }

            if ($anySchema->type === 'object') {
                $builder?->add($anySchema, $typeReal, $typeReal);
            }
            $types[] = $typeReal;
        }

        if ($isNullable) {
            \array_unshift($types, 'null');
        }

        return \implode('|', $types);
    }

    protected function camelize(string $string): string
    {
        return \lcfirst(
            \str_replace(
                [' ', '_'],
                '',
                \ucwords(\strtolower($string), " _"),
            ),
        );
    }
}
