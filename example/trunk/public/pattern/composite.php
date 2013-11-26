<?php

    include_once '../../class/pattern/composite.php';

    $archer = new Archer();
    echo "archer attacking with strength: {$archer->bombardStrength()}" . "<br/>";
    
    
    $main_army = new Army();
    
    $main_army->addUnit($archer);
    $main_army->addUnit(new Archer());
    $main_army->addUnit(new LaserCannonUnit());
    
    echo "main_army attacking with strength: {$main_army->bombardStrength()}" . "<br/>";
    
    $sub_army = new Army();
    
    $sub_army->addUnit(new Archer());
    $sub_army->addUnit(new Cavalry());
    $sub_army->addUnit(new Cavalry());
    echo "sub_army attacking with strength: {$sub_army->bombardStrength()}" . "<br/>";
    
    
    
    $main_army->addUnit($sub_army);
    
    echo "main_army attacking with strength: {$main_army->bombardStrength()}" . "<br/>";
    
    $troop = new TroopCarrier();
    
    //$troop->addUnit(new Cavalry);
    $troop->addUnit(new Archer());
    $troop->addUnit(new Archer());
    //$troop->addUnit(new Cavalry());
    
    echo "troop attacking with strength: {$troop->bombardStrength()}" . "<br/>";
    
    
    $main_army->addUnit($troop);
    
    echo "attacking with strength: {$main_army->bombardStrength()}" . "<br/>";
?>


