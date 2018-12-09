<?php

require_once "vendor/autoload.php";

$c = new \ToJavascript\Compiler;

echo $c->compile('
<html>
<body>
<?php

function abc($a, $b) {
    echo 123;
    return $b;
}

echo abc(123, 321);
?>
</body>
');
