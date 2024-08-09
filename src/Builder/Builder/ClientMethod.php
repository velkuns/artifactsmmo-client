<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder\Builder;

use cebe\openapi\spec\Parameter;
use PhpParser\Builder\Method;
use PhpParser\BuilderFactory;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Stmt\Return_;
use Velkuns\ArtifactsMMO\Builder\Enum\OperationType;

class ClientMethod extends Method
{
    /**
     * @param Parameter[] $pathParams
     */
    public function addAssignEndpoint(string $path, array $pathParams): self
    {
        $factory = new BuilderFactory();

        $endpointVar = $factory->var('endpoint');
        $this->addStmt(new Assign($endpointVar, $factory->val($path)));

        if (empty($pathParams)) {
            return $this;
        }

        //~ If necessary, add statement to replace endpoint path var by variables from method params
        $replace = [];
        foreach ($pathParams as $pathParam) {
            $replace['{' . $pathParam->name . '}'] = $factory->var($pathParam->name);
        }
        $replaceVar = $factory->var('replace');
        $this->addStmt(new Assign($replaceVar, $factory->val($replace)));
        $this->addStmt(
            new Assign(
                $endpointVar,
                $factory->funcCall(
                    '\str_replace',
                    [
                        $factory->funcCall('\array_keys', [$replaceVar]),
                        $factory->funcCall('\array_values', [$replaceVar]),
                        $endpointVar,
                    ],
                ),
            ),
        );

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
