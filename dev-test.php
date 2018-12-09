<?php

require_once "vendor/autoload.php";

$c = new \ToJavascript\Compiler;

echo $c->compile('
<?php

function abc($a, $b) {
    echo 123;
    a($a);
    return 0;
}

echo abc(123, 321);
');
