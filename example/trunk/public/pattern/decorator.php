<?php

    include_once '../../class/pattern/decorator.php';
    
    $tile = new Plains();
    
    echo $tile->getWealthFactor() . "<br>";
    
    $tile = new DiamondDecorator(new Plains());  // 平原+鑽石資源
    
    echo $tile->getWealthFactor() . "<br>";
    
    $tile = new PollutionDecorator(new DiamondDecorator(new Plains())); // 平原+鑽石資源+汙染
    
    echo $tile->getWealthFactor() . "<br>";
    
    
    //$process = new AuthenticateRequest(new StructureRequest( new LogRequest( new MainProcess())));
    //$process->process(new RequestHelper());
    
?>
