<?php 

// 沒使用memento範例

// 遊戲角色
class  Role 
{
    private $hp = 0;  // 體力
    private $mp = 0;  // 魔力
    private $dex = 0; // 敏捷
    private $atk = 0; // 攻擊力
    private $def = 0; // 防禦力

    public function __construct($hp, $mp, $dex, $atk, $def) {
        $this->hp = $hp;
        $this->mp = $mp;
        $this->dex = $dex;
        $this->atk = $atk;
        $this->def = $def;
    }
    
    public function getHp() {
        return $this->hp;
    }
    
    public function getMp() {
        return $this->mp;
    }
    
    public function getDex() {
        return $this->dex;
    }
    
    public function getAtk() {
        return $this->atk;
    }
    
    public function getDef() {
        return $this->def;
    }
    
    public function  setState($hp, $mp, $dex, $atk, $def) {
        $this->hp = $hp;
        $this->mp = $mp;
        $this->dex = $dex;
        $this->atk = $atk;
        $this->def = $def;
    }
    
    public function showState() {
        echo "角色當前狀態:<br/>";
        echo "體力:{$this->hp}<br/>";
        echo "魔力:{$this->mp}<br/>";
        echo "敏捷:{$this->dex}<br/>";
        echo "攻擊力:{$this->atk}<br/>";
        echo "防禦力:{$this->def}<br/><br/>";
    }
    
    public function fight() {
        $this->hp = 0;
        $this->mp = 0;
        $this->dex = 0;
        $this->atk = 0;
        $this->def = 0;
        
        echo "開打，被魔王秒殺...<br/>";
    }
}



// 遊戲角色(Originator)
class  Role 
{
    private $hp = 0;  // 體力
    private $mp = 0;  // 魔力
    private $dex = 0; // 敏捷
    private $atk = 0; // 攻擊力
    private $def = 0; // 防禦力

    public function __construct($hp, $mp, $dex, $atk, $def) {
        $this->hp = $hp;
        $this->mp = $mp;
        $this->dex = $dex;
        $this->atk = $atk;
        $this->def = $def;
    }
    
    public function  saveState() {
        return new Memento($this->hp, $this->mp, $this->dex, $this->atk, $this->def);
    }
    
    public function recoveryState(Memento $memento) {
        $this->hp = $memento->getHp();
        $this->mp = $memento->getMp();
        $this->dex = $memento->getDex();
        $this->atk = $memento->getAtk();
        $this->def = $memento->getDef();
    }
    
    public function showState() {
        echo "角色當前狀態:<br/>";
        echo "體力:{$this->hp}<br/>";
        echo "魔力:{$this->mp}<br/>";
        echo "敏捷:{$this->dex}<br/>";
        echo "攻擊力:{$this->atk}<br/>";
        echo "防禦力:{$this->def}<br/><br/>";
    }
    
    public function fight()
    {
        $this->hp = 0;
        $this->mp = 0;
        $this->dex = 0;
        $this->atk = 0;
        $this->def = 0;
        
        echo "開打，被魔王秒殺...<br/>";
    }
}

class Memento
{
    private $hp = 0;  // 體力
    private $mp = 0;  // 魔力
    private $dex = 0; // 敏捷
    private $atk = 0; // 攻擊力
    private $def = 0; // 防禦力
    
    public function __construct($hp, $mp, $dex, $atk, $def) {
        $this->hp = $hp;
        $this->mp = $mp;
        $this->dex = $dex;
        $this->atk = $atk;
        $this->def = $def;
    }
    
    public function getHp() {
        return $this->hp;
    }
    
    public function getMp() {
        return $this->mp;
    }
    
    public function getDex() {
        return $this->dex;
    }
    
    public function getAtk() {
        return $this->atk;
    }
    
    public function getDef() {
        return $this->def;
    }
}

class Caretaker 
{
    private $memento;
    
    public function getMemento() {
        return $this->memento;
    }
    
    public function setMemento(Memento $memento) {
        $this->memento = $memento;
    }
}


?>