<?php

    include_once '../../class/example/polymorphism.php';
    
    
    // 沒用到繼承，只是很單純使用別的類別方法來處理事情，不是多型
    /*
    $shape = new Shape();
    $circle = new Circle();
    $rectangle = new Rectangle();
    
    $shape->draw($circle);
    $shape->draw($rectangle);
    */
    
    /*
    $circle = new Circle();
    $rectangle = new Rectangle();
    */
    
     // $shape = new Shape();
     $circle = new Circle();
     $rectangle = new Rectangle();
     $drawer = new Drawer();
     
     $drawer->addShape($circle);
     $drawer->addShape($rectangle);
     
     $drawer->drawAllShapes();
     
     // $shapInterface = new ShapeInterface();
?>
