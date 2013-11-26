<?php

    include_once '../../class/pattern/singleton.php';
    

    $pref = Preferences::getInstance();
    
    $pref->setProperty("name", "matt");
    
    unset($pref);
    
    $pref2 = Preferences::getInstance();
    echo $pref2->getProperty("name");
    

?>