# php2js

Compile php code to javascript code.

## A simple test

```bash
$ cat ../examples/test_purpose.php
'
Something is:
<?php
function abc($a, $b) {
    ?>
    <script for="php2js">let something = Math.random();</script>
    <?php
    $something += $a;
    $b += $something;
    echo $something;
}
'

$ ./php2js ../examples/test_purpose.php ../examples/test_purpose.js

$ node ../examples/test_purpose.js
'
Something is:

123.53755374948133
'

$ cat ../examples/test_purpose.js
'
/**
 * Compiled by js2php.
 * js2php is written by xtlsoft.
 *
 */

console.log("Something is:\n");

function abc(a, b){
    let something = Math.random();
    (something += a);
    (b += something);
    console.log(something);
}

abc(123, 32231);

/** EOF **/
'
```
