<?php

namespace ToJavascript;

class Compiler {
    public static function compile(string $code): string {
        $walker = new Walker;
        $parser = (new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7);
        $asts = $parser->parse($code);
        // echo (new \PhpParser\NodeDumper)->dump($asts), PHP_EOL;
        $traverser = new \PhpParser\NodeTraverser;
        $traverser->addVisitor($walker);
        $traverser->traverse($asts);
        return $walker->generated;
    }
}