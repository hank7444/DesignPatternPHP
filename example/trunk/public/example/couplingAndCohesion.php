<?php

   include_once '../../class/example/couplingAndCohesion.php';
   
   $lister = new Lister(); 		 // 建立一個表格物件
   $circle1 = new Circle(10.11); // 建立circle1
   $square1 = new Square(6.22);  // 建立square1
 
   $lister->addItem($circle1);
   $lister->addItem($square1);
   $lister->out();
?>