<?php

    include_once '../../class/pattern/factory.php';

    $barrack = new Barrack();           // 建立軍營
    $solider = $barrack->outputUnit();  // 產生單位
    $solider->playSlogan();

   
    $commandCenter = new CommandCenter();   // 建立指揮中心
    $worker = $commandCenter->outputUnit(); // 產生單位
    $worker->playSlogan();
    
    
    $airport = new Airport();           // 建立機場
    $aircraft = $airport->outputUnit(); // 產生單位
    $aircraft->playSlogan();


?>