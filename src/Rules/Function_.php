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
                $e = $this->walker->endline();
                $this->walker->increaseTab();
                return "{$e}function {$node->name->name}($args){" . $this->walker->endline();
            },
            function () {
                $this->walker->reduceTab();
                return "}" . $this->walker->endline() . $this->walker->endline();
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
        $name = join(".", $node->name->parts);
        return ["{$name}($args)", ""];
    }

}