<?php

require_once "vendor/autoload.php";

$c = new \ToJavascript\Compiler;

echo $c->compile('
<html>
<body>
<?php

function abc($a, $b) {
    echo 123;
    return bcd($b, $a);
}

function bcd($b, $a) {
    echo $a;
    echo $b;
    return $a;
}

echo abc(123, 32231);
?>
</body>
');
