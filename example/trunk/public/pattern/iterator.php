<?php

    include_once '../../class/pattern/iterator.php';

    
    $archer = new Archer();
    $main_army = new Army();
    
    $main_army->addUnit($archer);
    $main_army->addUnit(new Archer());
    $main_army->addUnit(new LaserCannonUnit());
    

    $sub_army = new Army();
    
    $sub_army->addUnit(new Archer());
    $sub_army->addUnit(new Cavalry());
    $sub_army->addUnit(new Cavalry());

    
    $main_army->addUnit($sub_army);
    
    

    $compositeIterator = $main_army->createIterator();

    //$unit = $compositeIterator->current();
    //echo $unit->getName();

    $unit = $compositeIterator->next();
    echo $unit->getName();

    $unit = $compositeIterator->next();
    echo $unit->getName();

    $unit = $compositeIterator->next();
    echo $unit->getName();

    $unit = $compositeIterator->next();
    echo $unit->getName();

    $compositeIterator->next();
    $compositeIterator->next();

    echo "<br>";


    $subCompositeIterator = $unit->createIterator();

    $unit = $subCompositeIterator->next();
    echo $unit->getName();

    $unit = $subCompositeIterator->next();
    echo $unit->getName();

    $unit = $subCompositeIterator->next();
    echo $unit->getName();

    $subCompositeIterator->next();

?>