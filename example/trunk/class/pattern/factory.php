<?php


// 抽象的建築物工廠
abstract class BuildFactory 
{
    abstract function outputUnit();
}

// 指揮中心
class CommandCenter extends BuildFactory
{
    public function outputUnit() {
        return new Worker();
    }
}
// 軍營
class Barrack extends BuildFactory
{
    public function outputUnit() {
        return new Solider();
    }
}

// 空軍基地
class Airport extends BuildFactory
{
    public function outputUnit() {
        return new Aircraft();
    }
}

// 抽象單位
abstract class Unit
{
   public abstract function playSlogan();  // 播放單位口號
}

// 工人
class Worker extends Unit
{   
    public function playSlogan() {
        echo "SUV準備好了，長官你想蓋啥建築呢?<br/><br/>";
    }
}

// 士兵
class Solider extends Unit
{   
    public function playSlogan() {
        echo "快給我戰鬥藥吧!!<br/><br/>";
    }
}

// 飛機
class Aircraft extends Unit
{
    public function playSlogan() {
        echo "我已經準備好起飛出擊了，長官!<br/><br/>";
    }
}




?>