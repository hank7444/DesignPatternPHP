<?php

    include_once '../../class/pattern/prototype.php';
    
    $obj1 = new SubObject("obj1");
    $obj2 = new SubObject("obj2");

    // 產生一個NovelPrototype物件
    $novel1 = new NovelPrototype($obj1, $obj2, 'Novel1');
    $novel1->show();
    print_r($novel1);

    echo "<br><br>";

    // 複製$novel;
    $novel2 = clone $novel1;
    $novel2->show();
    print_r($novel2);

    // 修改novel2的title
    $novel2->setTitle('modified Novel2 Title');

    echo "<br><br>";
    $novel1->show();

    echo "<br><br>";
    $novel2->show();

    echo "<br><br>";
    $novel3 = $novel2;
    $novel3->show();
    print_r($novel3);

?>