<?php
    include_once '../../class/pattern/command.php';
    
    $remoteControl = new RemoteControl();
    
    $car = new Car();
    
    $carPowerOn = new PowerOnCommand($car);
    $carPowerOff = new PowerOffCommand($car);
    $carTurnLeft = new TurnLeftCommand($car);
    $carTurnRight = new TurnRightCommand($car);
    
    $remoteControl->setCommand(0, $carPowerOn);     // 將按鈕0號設為發動汽車引擎
    $remoteControl->setCommand(1, $carPowerOff);    // 將按鈕1號設為關閉汽車引擎
    $remoteControl->setCommand(2, $carTurnLeft);    // 將按鈕2號設為汽車左轉
    $remoteControl->setCommand(3, $carTurnRight);   // 將按鈕3號設為汽車右轉
    
    /*
    $remoteControl->execute(0);     // 按下按鈕0號
    $remoteControl->execute(1);     // 按下按鈕1號
    $remoteControl->execute(2);     // 按下按鈕2號
    $remoteControl->execute(3);     // 按下按鈕3號
    */

    // 設定蛇行巨集, 開啟引擎、左轉、右轉、關閉引擎
    $macroCmd = new MarcoCommand(array($carPowerOn, $carTurnLeft, $carTurnRight, $carPowerOff)); 

    // 將按鈕4號設為蛇行指令
    $remoteControl->setCommand(4, $macroCmd);   

    // 執行按鈕4號
    $remoteControl->execute(4); 
    
    
    
    /*
    $boat = new Boat();
    $boatPowerOn = new PowerOnCommand($boat);
    $boatPowerOff = new PowerOffCommand($boat);
    
    
    $remoteControl->setCommand(2, $boatPowerOn);   //將按鈕2號設為發動汽船引擎
    $remoteControl->setCommand(3, $boatPowerOff);  //將按鈕3號設為關閉汽船引擎
    */
    
    
    
        
    
 
?>
