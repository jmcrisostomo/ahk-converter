<?php

    $foo = "à";

    // [\x80-\xFF] regex for extended ascii characters

    echo dechex(mb_ord($foo));
?>