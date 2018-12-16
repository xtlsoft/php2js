<?php

namespace ToJavascript\Rules;

class Print_ {

    public $walker = null;

    public function stmtEcho($node) {
        return ["{$this->walker->configure['printFunction']}(", ");" . $this->walker->endline()];
    }

    public function stmtInlineHTML($node) {
        if (substr(trim($node->value), 0, 21) == '<script for="php2js">') {
            if (substr(trim($node->value), -9) == '</script>') {
                $value = trim($node->value);
                $value = substr($value, 21);
                $value = substr($value, 0, strlen($value) - 9);
                return [$value, $this->walker->endline()];
            }
        }
        return ["{$this->walker->configure['printFunction']}(" . json_encode($node->value), ");" . $this->walker->endline()];
    }

}