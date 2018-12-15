<?php

namespace ToJavascript\Rules;

class Function_ {

    public function stmtFunction($node) {
        $args = "";
        $first = 1;
        foreach ($node->params as &$arg) {
            if (!$first) $args .= ", ";
            else $first = 0;
            $args .= \ToJavascript\Compiler::compile($arg, ["copyright" => false]);
            $arg = null;
        }
        return [
            function () use ($node, $args) {
                $this->walker->increaseTab();
                return "function {$node->name->name}($args){" . $this->walker->endline();
            },
            function () {
                $this->walker->reduceTab();
                return "}" . $this->walker->endline();
            }
        ];
    }

    public function exprFuncCall($node) {
        $args = "";
        $first = 1;
        foreach ($node->args as &$arg) {
            if (!$first) $args .= ", ";
            else $first = 0;
            $args .= \ToJavascript\Compiler::compile($arg, ["copyright" => false]);
            $arg = null;
        }
        $name = join("_", $node->name->parts);
        return ["{$name}($args)", ""];
    }

}