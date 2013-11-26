<?php

    include_once '../../class/example/abstractClassAndInterface.php';
    
    $pet = new Pet("pet",6);
    $human = new Human(100, 'human', 27);
    $shark = new Shark(200, 15);
    $house = new House();

    $insurableReader = new InsurableReader(); // Insurable讀取器
    
    $insurableReader->addItem($pet);
    $insurableReader->addItem($human); 
    //$insurableReader->addItem($shark);     // Shark沒有定義Insurable這個interface，故發生錯誤
    $insurableReader->addItem($house);
    $insurableReader->printItems();
    
    
    echo '<br/>';
    
    $animalReader = new AnimalReader(); // Animal讀起器
    
    $animalReader->addItem($pet);
    $animalReader->addItem($human); 
    $animalReader->addItem($shark); 
    //$animalReader->addItem($house);  // House沒有繼承至Animal這個abstract class，故發生錯誤
    $animalReader->printItems();
?>
