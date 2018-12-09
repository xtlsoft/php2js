<?php

namespace ToJavascript;

use PhpParser\{Node, NodeTraverser, NodeVisitorAbstract};
use PhpParser\Node\{Stmt, Scalar, Name, Expr};

class Walker extends NodeVisitorAbstract {

    public $generated = "";
    public $copyright = true;

    public function enterNode(Node $node) {
        $append = function ($a) {$this->generated .= $a;};
        if ($node instanceof Stmt\InlineHTML) {
            $append("console.log(" . str_replace("\n", "\\n", var_export($node->value, 1)) . ");\r\n");
        } else if ($node instanceof Stmt\Echo_) {
            $append("console.log(");
        } else if ($node instanceof Scalar\LNumber || $node instanceof Scalar\DNumber || $node instanceof Scalar\String_) {
            $append(str_replace("\n", "\\n", var_export($node->value, 1)));
        } else if ($node instanceof Stmt\Function_) {
            $args = "";
            $c = new self;
            $c->copyright = false;
            $traverser = new \PhpParser\NodeTraverser;
            $traverser->addVisitor($c);
            $args = "";
            $first = 1;
            foreach ($node->params as &$arg) {
                if (!$first) $args .= ", ";
                else $first = 0;
                $traverser->traverse([$arg]);
                $args .= $c->generated;
                $arg = null;
            }
            $append("function {$node->name->name}($args) {\r\n");
        } else if ($node instanceof Stmt\Return_) {
            $append("return ");
        } else if ($node instanceof Expr\FuncCall) {
            $c = new self;
            $c->copyright = false;
            $traverser = new \PhpParser\NodeTraverser;
            $traverser->addVisitor($c);
            $args = "";
            $first = 1;
            foreach ($node->args as &$arg) {
                if (!$first) $args .= ", ";
                else $first = 0;
                $traverser->traverse([$arg]);
                $args .= $c->generated;
                $arg = null;
            }
            $append("{$node->name->parts[0]}($args)");
        } else if ($node instanceof Expr\Variable) {
            $append("{$node->name}");
        }
    }

    public function leaveNode(Node $node) {
        $append = function ($a) {$this->generated .= $a;};
        if ($node instanceof Stmt\Echo_) {
            $append(");\r\n");
        } else if ($node instanceof Stmt\Function_) {
            $append("}\r\n");
        } else if ($node instanceof Stmt\Return_) {
            $append(";\r\n");
        } else if ($node instanceof Stmt\Expression) {
            $append(";\r\n");
        }
    }

    public function afterTraverse(array $nodes) {
        if ($this->copyright)
            $this->generated .= "\r\n/** EOF **/";
    }

    public function beforeTraverse(array $nodes) {
        if ($this->copyright)
            $this->generated = <<<EOF
/**
 * Compiled by js2php.
 * js2php is written by xtlsoft.
 * 
 */

EOF;
        else $this->generated = "";
    }

}