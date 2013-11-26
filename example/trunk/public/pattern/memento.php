<?php
    include_once '../../class/pattern/memento.php';

    // 未使用Memento範例
    /*
    $jack = new Role(100, 30, 60, 40, 35); // 建立遊戲角色
    $jack->showState();
    
    $backup = new Role(0, 0, 0, 0, 0);
    $backup->setState($jack->getHp(), $jack->getMp(),    // 備份目前狀態，
                       $jack->getDex(), $jack->getAtk(), // 但是這邊暴露了實作細節
                       $jack->getDef());
    
    $jack->fight(); // 開打，死掉了
    $jack->showState();
    
    $jack->setState($backup->getHp(), $backup->getMp(),   // 回復之前狀態
                     $backup->getDex(), $backup->getAtk(), 
                     $backup->getDef());
    
    $jack->showState();
    */
    
    // 使用Memento範例
    $jack = new Role(100, 30, 60, 40, 35); // 建立遊戲角色
    $jack->showState();
    
    $caretaker = new Caretaker();
    
    $caretaker->setMemento($jack->saveState()); // 備份目前狀態
    
    $jack->fight(); // 開打，死掉了
    $jack->showState();
    
    $jack->recoveryState($caretaker->getMemento()); // 回復之前狀態
    $jack->showState();
    
?>