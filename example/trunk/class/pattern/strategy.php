<?php

// 武將
class Officer
{ 
    private $Name;
    private $Mp;       // 技能點數
    private $Strategy; // 兵法
    
    public function __construct($name, $mp, Strategy $strategy) {
        $this->Name = $name;
        $this->Mp = $mp;
        $this->Strategy = $strategy;
    }

    // 使用兵法  
    public function useStrategy() {
        return $this->Name . " 使用了" . $this->Strategy->StrategyName() . ", " . $this->Strategy->useStrategy($this);
    }
    
    public function setStractegy(Strategy $strategy) {
        $this->Strategy = $strategy;
    }
    
    public function getMp(){
        return $this->Mp;
    }
    
    public function setMp($mp){
        $this->Mp = $mp;
    }
}



abstract class Strategy 
{
    abstract function useStrategy(Officer $officer);
    abstract function StrategyName();
}

// 火牛陣
class FireBullStrategy extends Strategy 
{ 
    public function useStrategy(Officer $officer) {
        $mp = $officer->getMp() - 10;
        $officer->setMp($mp);
        return '敵方受到 30 點傷害，並且造成混亂，還剩 '. $mp . ' 點MP';
    }
    
    public function StrategyName() {
        return "火牛陣";
    }
}

// 嘲弄術
class ScoffStrategy extends Strategy {  
    public function useStrategy(Officer $officer) {
        $mp = $officer->getMp() - 5;
        $officer->setMp($mp);
        return '敵方士氣下降 15 點，還剩 ' . $mp . ' 點MP';
    }
    
    public function StrategyName() {
        return "嘲弄術";
    }
}


?>