<?php

namespace ToJavascript;

class Compiler {
    public static $rules = [
        Rules\Print_::class,
        Rules\Scalars::class,
        Rules\ControlFlow::class,
        Rules\Function_::class,
        Rules\Operators::class,
    ];
    public static function compile($code, array $configure = []): string {
        $walker = new Walker;
        foreach (self::$rules as $rule) {
            $walker->register($rule);
        }
        $walker->configure = array_merge($walker->configure, $configure);
        if (is_string($code)) {
            $parser = (new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7);
            $asts = $parser->parse($code);
            // echo (new \PhpParser\NodeDumper)->dump($asts), PHP_EOL;
        } else {
            $asts = [$code];
        }
        $traverser = new \PhpParser\NodeTraverser;
        $traverser->addVisitor($walker);
        $traverser->traverse($asts);
        return $walker->generated;
    }
}