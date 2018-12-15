<?php

namespace ToJavascript;

use PhpParser\{Node, NodeTraverser, NodeVisitorAbstract};
use PhpParser\Node\{Stmt, Scalar, Name, Expr};

class Walker extends NodeVisitorAbstract {

    public $generated = "";
    public $configure = [
        "printFunction" => "console.log",
        "endline" => "\r\n",
        "tab" => "    ",
        "copyright" => true,
    ];
    protected $currentTab = "";

    public $rules = [];

    public function register(string $className) {
        $this->rules = array_merge($this->rules, Tool::generateRule($className));
        return $this;
    }

    public function enterNode(Node $node) {
        $f = Tool::doRule($this, $node)[0];
        $this->generated .= $f();
    }

    public function leaveNode(Node $node) {
        $f = Tool::doRule($this, $node)[1];
        $this->generated .= $f();
    }

    public function afterTraverse(array $nodes) {
        if ($this->configure['copyright'])
            $this->generated .= "\r\n/** EOF **/";
    }

    public function endline(bool $reduceTab = false) {
        if ($reduceTab) $this->reduceTab();
        return $this->configure['endline'] . $this->currentTab;
    }

    public function reduceTab() {
        $this->currentTab = substr($this->currentTab, 0, strlen($this->currentTab) - strlen($this->configure['tab']));
        $this->generated = substr($this->generated, 0, strlen($this->generated) - strlen($this->configure['tab']));
        return $this;
    }

    public function increaseTab() {
        $this->currentTab .= $this->configure['tab'];
        return $this;
    }

    public function beforeTraverse(array $nodes) {
        if ($this->configure['copyright'])
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