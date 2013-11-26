<?php

    include_once '../../class/pattern/interpreter.php';

    $statement = "1 + 2 + 8 - 50";

    $calculator = new Calculator();
    $calculator->build($statement);
    $result = $calculator->compute();

    echo "計算結果:" . $result;
?>