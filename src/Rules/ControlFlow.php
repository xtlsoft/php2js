<?php

namespace ToJavascript\Rules;

class ControlFlow {

    public $walker = null;

    public function stmtReturn($node) {
        return ["return ", ";" . $this->walker->endline()];
    }

    public function stmtExpression($node) {
        return ["", ";" . $this->walker->endline()];
    }

    public function stmtIf($node) {
        $cond = \ToJavascript\Compiler::compile($node->cond, ["copyright" => false]);
        $node->cond = null;
        return [
            function () use ($cond, $node) {
                $this->walker->increaseTab();
                return "if ($cond) {" . $this->walker->endline();
            },
            function () use ($node) {
                $this->walker->reduceTab();
                return "}" . $this->walker->endline();
            }
        ];
    }

    public function stmtElseIf($node) {
        $cond = \ToJavascript\Compiler::compile($node->cond, ["copyright" => false]);
        $node->cond = null;
        return [
            function () use ($cond, $node) {
                $this->walker->reduceTab();
                $this->walker->increaseTab();
                return "} else if ($cond) {" . $this->walker->endline();
            },
            function () use ($node) {
                return "";
            }
        ];
    }

    public function stmtElse($node) {
        return [
            function () use ($node) {
                $this->walker->reduceTab();
                $this->walker->increaseTab();
                return "} else {" . $this->walker->endline();
            },
            function () use ($node) {
                return "";
            }
        ];
    }

    public function stmtWhile($node) {
        $cond = \ToJavascript\Compiler::compile($node->cond, ["copyright" => false]);
        $node->cond = null;
        return [
            function () use ($cond, $node) {
                $this->walker->increaseTab();
                return "while ($cond) {" . $this->walker->endline();
            },
            function () use ($node) {
                $this->walker->reduceTab();
                return "}" . $this->walker->endline();
            }
        ];
    }

    public function stmtDo($node) {
        $cond = \ToJavascript\Compiler::compile($node->cond, ["copyright" => false]);
        $node->cond = null;
        return [
            function () use ($node) {
                $this->walker->increaseTab();
                return "do {" . $this->walker->endline();
            },
            function () use ($cond, $node) {
                $this->walker->reduceTab();
                return "} while ({$cond});" . $this->walker->endline();
            }
        ];
    }

    public function stmtFor($node) {
        $cond = "";
        $first = 1;
        foreach ($node->cond as $c) {
            if ($first) $first = 0;
            else $cond .= ", ";
            $cond .= \ToJavascript\Compiler::compile($c, ["copyright" => false]);
        }
        $node->cond = null;
        $loop = "";
        $first = 1;
        foreach ($node->loop as $c) {
            if ($first) $first = 0;
            else $loop .= ", ";
            $loop .= \ToJavascript\Compiler::compile($c, ["copyright" => false]);
        }
        $node->loop = null;
        $init = "";
        $first = 1;
        foreach ($node->init as $c) {
            if ($first) $first = 0;
            else $init .= ", ";
            $init .= \ToJavascript\Compiler::compile($c, ["copyright" => false]);
        }
        $node->init = null;
        return [
            function () use ($init, $cond, $loop, $node) {
                $this->walker->increaseTab();
                return "for ($init; $cond; $loop) {" . $this->walker->endline();
            },
            function () use ($node) {
                $this->walker->reduceTab();
                return "}" . $this->walker->endline();
            }
        ];
    }

}