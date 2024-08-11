<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Script\Builder\Builder;

use cebe\openapi\spec\Parameter;
use PhpParser\Builder\Method;
use PhpParser\BuilderFactory;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Return_;
use Velkuns\ArtifactsMMO\Script\Builder\Enum\OperationType;

class ClientMethod extends Method
{
    /**
     * @param Parameter[] $pathParams
     */
    public function addAssignEndpoint(string $path, array $pathParams): self
    {
        $factory     = new BuilderFactory();
        $endpointVar = $factory->var('endpoint');

        if (empty($pathParams)) {
            $this->addStmt(new Assign($endpointVar, new String_($path)));

            return $this;
        }

        //~ Use variable in path
        $replace = [];
        foreach ($pathParams as $pathParam) {
            $replace['{' . $pathParam->name . '}'] = '$' . $pathParam->name;
        }
        $path = \str_replace(\array_keys($replace), \array_values($replace), $path);
        $this->addStmt(new Assign($endpointVar, new String_($path, ['kind' => String_::KIND_DOUBLE_QUOTED, 'noEscape' => true])));

        return $this;
    }

    public function addCallBuilder(bool $withQuery, bool $withBody, OperationType $operationType): self
    {
        $factory = new BuilderFactory();

        $params = [$factory->var('endpoint')];
        if ($withQuery) {
            $params['query'] = $factory->var('query');
        }
        if ($withBody) {
            $params['body'] = $factory->methodCall($factory->var('body'), 'jsonSerialize');
        }
        $params['method'] = strtoupper($operationType->name);

        $thisVar        = $factory->var('this');
        $builderCall    = $factory->methodCall($thisVar, 'getRequestBuilder');
        $chainBuildCall = $factory->methodCall($builderCall, 'build', $params);
        $requestVar     = $factory->var('request');

        $this->addStmt(new Assign($requestVar, $chainBuildCall));

        return $this;
    }

    /**
     * @param array{realType: string, type: string} $returnType
     */
    public function addReturnData(array $returnType): self
    {
        $factory = new BuilderFactory();

        $requestVar      = $factory->var('request');
        $formatterNew    = $factory->new("Formatter\\{$returnType['type']}Formatter");
        $params          = [$requestVar, $formatterNew];
        if ($returnType['realType'] === 'array') {
            $fetchCall = $factory->methodCall($factory->var('this'), 'fetchVOList', $params);
        } else {
            $fetchCall = $factory->methodCall($factory->var('this'), 'fetchVO', $params);
        }

        $this->addStmt(new Return_($fetchCall));

        return $this;
    }
}
