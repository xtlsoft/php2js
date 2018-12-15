<?php

namespace ToJavascript\Rules;

class ControlFlow {

    public $walker = null;

    public function stmtReturn($node) {
        return ["return ", ";" . $this->walker->endline()];
    }

    public function stmtExpression($node) {
        return [";" . $this->walker->endline()];
    }

}