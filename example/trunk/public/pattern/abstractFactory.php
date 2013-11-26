<?php

    include_once '../../class/pattern/abstractFactory.php';

    $barrack = new Barrack(); //建立軍營
    $terranUnit = $barrack->outputTerranUnit(); //產生人類士兵
    $zergUnit = $barrack->outputZergUnit(); //產生異形士兵

    $terranUnit->playSlogan();
    $zergUnit->shout();

   
    $commandCenter = new CommandCenter(); //建立指揮中心
    $terranUnit = $commandCenter->outputTerranUnit(); //產生人類工兵
    $zergUnit = $commandCenter->outputZergUnit(); //產生異形工兵

    $terranUnit->playSlogan();
    $zergUnit->shout();

    
    $airport = new Airport(); //建立機場
    $terranUnit =  $airport->outputTerranUnit(); //產生人類飛機
    $zergUnit = $airport->outputZergUnit(); //產生異形飛機

    $terranUnit->playSlogan();
    $zergUnit->shout();

?>