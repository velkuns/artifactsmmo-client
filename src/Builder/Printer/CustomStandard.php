<?php

/*
 * Copyright (c) velkuns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Builder\Printer;

use PhpParser\PrettyPrinter\Standard;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;

class CustomStandard extends Standard
{
    protected function pExpr_Array(Expr\Array_ $node)
    {
        if (empty($this->options['arrayMultiline'])) {
            return parent::pExpr_Array($node);
        }

        //~ When line is to long, force multiline
        $syntax = $node->getAttribute(
            'kind',
            $this->options['shortArraySyntax'] ? Expr\Array_::KIND_SHORT : Expr\Array_::KIND_LONG,
        );

        if ($syntax === Expr\Array_::KIND_SHORT) {
            $line = '[' . $this->pCommaSeparatedMultiline($node->items, true) . $this->nl . ']';
        } else {
            $line = 'array(' . $this->pCommaSeparatedMultiline($node->items, true) . ')';
        }

        return $line;
    }

    protected function pStmt_ClassMethod(Stmt\ClassMethod $node)
    {
        if (empty($this->options['methodMultiline'])) {
            return parent::pStmt_ClassMethod($node);
        }

        return $this->pAttrGroups($node->attrGroups)
            . $this->pModifiers($node->flags)
            . 'function ' . ($node->byRef ? '&' : '') . $node->name
            . '(' . $this->pCommaSeparatedMultiline($node->params, true) . $this->nl . ')'
            . (null !== $node->returnType ? ' : ' . $this->p($node->returnType) : '')
            . (null !== $node->stmts
                ? $this->nl . '{' . $this->pStmts($node->stmts) . $this->nl . '}'
                : ';');
    }

    protected function pExpr_New(Expr\New_ $node)
    {
        if (empty($this->options['newMultiline'])) {
            return parent::pExpr_New($node);
        }

        if ($node->class instanceof Stmt\Class_) {
            $args = $node->args ? '(' . $this->pCommaSeparatedMultiline($node->args, true) . $this->nl . ')' : '';
            return 'new ' . $this->pClassCommon($node->class, $args);
        }
        return 'new ' . $this->pNewVariable($node->class)
            . '(' . $this->pCommaSeparatedMultiline($node->args, true) . $this->nl . ')';
    }
}
