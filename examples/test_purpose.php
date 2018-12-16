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

abc(123, 32231);