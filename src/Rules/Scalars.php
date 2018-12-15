<?php

namespace ToJavascript\Rules;

class Scalars {

    public $walker = null;

    public function scalarLNumber($node) {
        return $this->scalarDNumber($node);
    }

    public function scalarDNumber($node) {
        return $this->scalarString($node);
    }

    public function scalarString($node) {
        return [json_encode($node->value), ""];
    }

    public function exprVariable($node) {
        return [$node->name, ""];
    }

}