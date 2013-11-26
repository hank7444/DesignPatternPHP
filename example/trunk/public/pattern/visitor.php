<?php
    include_once '../../class/pattern/visitor.php';


    $archer = new Archer();
    
    $textdump = new TextDumpArmyVisitor(); 
    $archer->accept($textdump);
    echo $textdump->getText();
    
    echo "<br/>";
    
    $main_army = new Army();
    $main_army->addUnit(new Archer());
    $main_army->addUnit(new LaserCannonUnit());
    $main_army->addUnit(new Cavalry());
    
    $sub_army = new Army();
    $sub_army->addUnit(new Archer());
    $sub_army->addUnit(new Archer());
    $sub_army->addUnit(new Archer());
    
    $main_army->addUnit($sub_army);
    $main_army->accept($textdump);
    echo $textdump->getText();
    
    echo "<br/>";
    
    //列出每個單位要繳的稅金
    $taxcollector = new TaxCollectionVisitor();
    
    $archer->accept($taxcollector);
    echo $taxcollector->getReport();
    
    echo "<br/>";
    
    $main_army->accept($taxcollector);
    echo $taxcollector->getReport();
    
    
    echo "<br/>";
    
    //列出總和
    echo "total:" . $taxcollector->getTax();
    
    
    /*
    $troop = new TroopCarrier();
    
    //$troop->addUnit(new Cavalry);
    $troop->addUnit(new Archer());
    $troop->addUnit(new Archer());
    //$troop->addUnit(new Cavalry());
    
    $main_army->addUnit($troop);
    
    echo "attacking with strength: {$main_army->bombardStrength()}";
    */
    
?>
