<?php

require_once "vendor/autoload.php";

$c = new \ToJavascript\Compiler;

echo $c->compile('
<html>
<body>
<?php

function abc($a, $b) {
    ?>
    <script for="php2js">Math.random();</script>
    <?php
    while ($a > 0) {
        $b -= 2;
        $a -= 1;
    }
    do {
        $a += 1;
    } while ($a < 10);
    for ($i = 0; $i <= 100; $i += 1) {
        if ($i % 10 == 2):
            $a ++;
        endif;
    }
    return $a + $b - 2 * $b / 3;
}

echo abc(123, 32231);
?>
</body>
');
