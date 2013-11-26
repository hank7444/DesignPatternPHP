<?php

    include_once '../../class/pattern/strategy.php';
    
    $officer = new Officer("諸葛亮", 100, new FireBullStrategy());
    echo $officer->useStrategy();
    
    echo '<br/>';
    
    $officer->setStractegy(new ScoffStrategy());
    echo $officer->useStrategy();

?>