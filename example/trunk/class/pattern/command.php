<?php

/*
 Command模式
 * 
優點:
 
1.降低系统的耦合度。
2.新的命令可以很容易地加入到系统中。
3.可以比较容易地设计一个组合命令。

缺點:
使用命令模式可能会导致某些系统有过多的具体命令类。因为针对每一个命令都需要设计一个具体命令类，因此某些系统可能需要大量具体命令类，这将影响命令模式的使用


使用時間:
1.系统需要将请求调用者和请求接收者解耦，使得调用者和接收者不直接交互。
2.系统需要在不同的时间指定请求、将请求排队和执行请求。
3.系统需要支持命令的撤销(Undo)操作和恢复(Redo)操作。
4.系统需要将一组操作组合在一起，即支持巨集命令。


情境模擬:
 
現在我們要設計一個遙控汽車的遙控器，這個遙控器上有八個按鈕， 初期我們只會有四個按鍵是有功能的，
 * 其餘四個保留做為未來擴充之用，同時我們希望按鍵上的功能不是直接設計在遙控器上，
 * 這個遙控器現在是用來遙控小汽車，但是要將它改成 電視或其它東西的遙控器，只要裝上不同的按鍵即可。
 * 也就是說，遙控器只用來發出命令給實際 執行命令的東西，並不需要知道命令的執行細節。

 */

// Receiver
abstract class Vehicle
{
    public abstract function powerOn();
    public abstract function powerOff();
    public abstract function move();
    public abstract function stop();
}

// ConcreteReceiver
class Car extends Vehicle
{   
    public function powerOn() {    
        
        echo "汽車引擎發動<BR/>";
    
    }
    
    public function powerOff() {
    
        echo "汽車引擎關閉<BR/>";
    }
    
    public function move() {
    
        echo "汽車前進<BR/>";
    }
    
    public function stop() {
    
        echo "汽車停止<BR/>";
        
    }  
    
    public function turnLeft() {
        echo "汽車左轉<BR/>";
    }
    
    public function turnRight() {
        echo "汽車右轉<BR/>";
    }
}

class Boat extends Vehicle
{
    public function powerOn() {
        echo "汽船引擎發動<BR/>";
    }
    
    public function powerOff() {
        echo "汽船引擎停止<BR/>";
    }
    
    public function move() {
        echo "汽船前進<BR/>";
    }
    
    public function stop() {
        echo "汽船停止<BR/>";
    }
}



// Command 這邊用abstract class也可以
interface Command
{  
    public function execute();
}

// ConcreteCommand
class PowerOnCommand implements Command
{
    private $vehicle;
    
    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }
    
    public function execute() {
        
        $this->vehicle->powerOn();
        
    }
}

class PowerOffCommand implements Command
{
    private $vehicle;
    
    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }
    
    public function execute() {
        $this->vehicle->powerOff();
        
    }
}

class TurnLeftCommand implements Command
{
    private $vehicle;
    
    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }
    
    public function execute() {  
        $this->vehicle->turnLeft();   
    }
}

class TurnRightCommand implements Command
{
    private $vehicle;
    
    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }
    
    public function execute() {
        $this->vehicle->turnRight();
        
    }
}

// 空指令
class NoCommand implements Command
{
    public function execute(){}
}

// 如果想加一個蛇行的功能時...實作巨集命令
class MarcoCommand implements Command
{
    private $commands = array();
    
    public function __construct($commands) {
        $this->commands = $commands;
    }
    
    public function execute() {
        foreach($this->commands as $command) {
           $command->execute();
       }
    }
}



// Invoker
class RemoteControl
{
    private $commands = array(8);
    
    // 建立八個沒任何命令的空按鈕
    function __construct() { 
        for($i=0; $i<8; $i++) {
            $this->commands[$i] = new NoCommand();
        }
    }

    // 設定按鈕命令
    function setCommand($slot, Command $cmd) { 
        //array_push($this->commands, $cmd);
        $this->commands[$slot] = $cmd;
    }
    
    // 按下按鈕
    function execute($slot) {    
        /*
        foreach($this->commands as $key => $value){
            $this->commands[$key]->execute();
        }*/
        $this->commands[$slot]->execute();
    }
}




?>
