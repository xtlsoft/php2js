<?php

namespace ToJavascript;

class Tool {

    public static function generateRule(string $className) {
        $methods = get_class_methods($className);
        $vals = array_map(function () use ($className) {
            return $className;
        }, $methods);
        return array_combine($methods, $vals);
    }

    public static function generateMethodName($node) {
        $className = get_class($node);
        $className = str_replace("_", "", $className);
        $className = str_replace("PhpParser\\Node\\", "", $className);
        $className = str_replace("\\", "", $className);
        $className[0] = strtolower($className[0]);
        return $className;
    }

    public static function doRule($walker, $node) {
        $method = self::generateMethodName($node);
        if (!isset($walker->rules[$method])) return [function () { return ""; }, function () { return ""; }];
        $class = $walker->rules[$method];
        $c = new $class;
        $c->walker = $walker;
        $rslt = $c->{$method}($node);
        if (is_string($rslt[0])) {
            $a = $rslt[0];
            $rslt[0] = function () use ($a) { return $a; };
        }
        if (is_string($rslt[1])) {
            $a = $rslt[1];
            $rslt[1] = function () use ($a) { return $a; };
        }
        return $rslt;
    }

}