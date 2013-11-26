<?php

    include_once '../../class/pattern/state.php';
    
    $candyMachine = new CandyMachine(4);
    
    echo '<br/>';
    
    $candyMachine->insertCoin();
    $candyMachine->insertCoin();
    $candyMachine->ejectCoin();
    $candyMachine->ejectCoin();
    $candyMachine->turnCrank();
    $candyMachine->dispense();
    
    echo '<br/>';
    
    $candyMachine->insertCoin();
    $candyMachine->turnCrank();
    $candyMachine->dispense();
    
    echo '<br/>';
    
    $candyMachine->turnCrank();
    $candyMachine->dispense();
    
    echo '<br/>';
    
    $candyMachine->insertCoin();
    $candyMachine->turnCrank();
    $candyMachine->ejectCoin();
    $candyMachine->dispense();
    
    
    echo '<br/>';
    $candyMachine->insertCoin();
    $candyMachine->turnCrank();
    $candyMachine->dispense();
    $candyMachine->ejectCoin();
     
    
?>