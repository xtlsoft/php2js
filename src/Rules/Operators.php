<?php

namespace ToJavascript\Rules;

class Operators {

    public function exprBinaryOpPlus($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left + $right)", ""];
    }

    public function exprAssignOpPlus($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left += $right)", ""];
    }

    public function exprBinaryOpMinus($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left - $right)", ""];
    }

    public function exprAssignOpMinus($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left -= $right)", ""];
    }

    public function exprBinaryOpMul($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left * $right)", ""];
    }

    public function exprAssignOpMul($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left *= $right)", ""];
    }

    public function exprBinaryOpDiv($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left / $right)", ""];
    }

    public function exprAssignOpDiv($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left /= $right)", ""];
    }

    public function exprAssign($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left = $right)", ""];
    }

    public function exprBinaryOpEqual($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left == $right)", ""];
    }

    public function exprBinaryOpGreater($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left > $right)", ""];
    }

    public function exprBinaryOpGreaterOrEqual($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left >= $right)", ""];
    }

    public function exprBinaryOpSmaller($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left < $right)", ""];
    }

    public function exprBinaryOpSmallerOrEqual($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left < $right)", ""];
    }

    public function exprBinaryOpNotEqual($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left != $right)", ""];
    }

    public function exprBinaryOpMod($node) {
        $left = \ToJavascript\Compiler::compile($node->left, ["copyright" => false]);
        $node->left = null;
        $right = \ToJavascript\Compiler::compile($node->right, ["copyright" => false]);
        $node->right = null;
        return ["($left % $right)", ""];
    }

    public function exprAssignOpMod($node) {
        $left = @$node->var->name; $node->var = null;
        $right = \ToJavascript\Compiler::compile($node->expr, ["copyright" => false]);
        $node->expr = null;
        return ["($left %= $right)", ""];
    }

}