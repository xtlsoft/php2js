<?php

namespace ToJavascript\Rules;

class Print_ {

    public $walker = null;

    public function stmtEcho($node) {
        return ["{$this->walker->configure['printFunction']}(", ");" . $this->walker->endline()];
    }

    public function stmtInlineHTML($node) {
        return ["{$this->walker->configure['printFunction']}(" . json_encode($node->value), ");" . $this->walker->endline()];
    }

}