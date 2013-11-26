<?php
/*
 * 當今天我們有兩個陣營，人類跟蟲族時，工廠模式就要擴展成抽象工廠
 */


// 抽象的建築物工廠
abstract class BuildFactory 
{
    public abstract function outputTerranUnit(); // 產出人類單位
    public abstract function outputZergUnit();   // 產生異形單位
}

// 指揮中心
class CommandCenter extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranWorker();
    }
    
    public function outputZergUnit() {
        return new ZergWorker();
    }
}

// 軍營
class Barrack extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranSolider();
    }
    
    public function outputZergUnit() {
        return new ZergSolider();
    }
}

// 空軍基地
class Airport extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranAircraft();
    }
    
    public function outputZergUnit() {
        return new ZergAircraft();
    }
}

// 抽象人類單位
abstract class TerranUnit
{
   public abstract function playSlogan(); // 播放單位口號
}

// 工人
class TerranWorker extends TerranUnit
{
    public function playSlogan() {
        echo "SUV準備好了，長官你想蓋啥建築呢?<br/><br/>";
    }
}

// 士兵
class TerranSolider extends TerranUnit
{
    public function playSlogan() {
        echo "快給我戰鬥藥吧!!<br/><br/>";
    }
}

// 飛機
class TerranAircraft extends TerranUnit
{
    public function playSlogan() {
        echo "我已經準備好起飛出擊了，長官!<br/><br/>";
    }
}





// 抽象蟲族單位
abstract class ZergUnit
{
   public abstract function shout(); // 嘶吼
}

// 工人
class ZergWorker extends ZergUnit
{
    public function shout() {
        echo "(黏液黏液)，請問主宰您想長出什麼建築物?<br/><br/>";
    }
}

// 士兵
class ZergSolider extends ZergUnit
{
    public function shout() {
        echo "給我更多的人類!!!<br/><br/>";
    }
}

// 飛螳
class ZergAircraft extends ZergUnit
{
    public function shout() {
        echo "嘎~~~~嘎~~~~~嘎~~~~<br/><br/>";
    }
}




?>