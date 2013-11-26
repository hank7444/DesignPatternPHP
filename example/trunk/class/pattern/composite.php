<?php

/*
 *案例:遊戲有許多戰鬥單位，獨立的單位可以組合起來一起移動與攻擊敵人 
 * 一開始我們會這麼寫...
 */

/*
// 抽象戰鬥單元
abstract class Unit 
{   
    public abstract function bombardStrength(); // 輸出戰鬥單位的攻擊力
}

class Archer extends Unit // 弓箭手
{     
    public function bombardStrength() {
      return 4;
    }
} 


class LaserCannonUnit extends Unit // 雷射加農砲
{  
    public function bombardStrength() {
      return 44;
    }
}

class Army 
{
    private $units = array();
 
    public function addUnit(Unit $unit) {       // 將一戰鬥單位加入到軍隊群組中
        array_push($this->units, $unit);
    }
   
    public function bombardStrength() {         // 輸出整個軍隊的攻擊力
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}
*/

/* 這時候有新的需求，軍隊應該要能夠與其他軍隊合併，並且以後還可以從整併後的軍隊中解散出來 */
/*
 class Army 
 {
    private $units = array();
  
    public function addArmy( Army $army) {     // 將一軍隊整編進來
        array_push($this->armies, $army);
    }
 
    public function addUnit(Unit $unit){       // 將一戰鬥單位加入到軍隊群組中
        array_push($this->units, $unit);
    }
   
    public function bombardStrength() {         // 輸出整個軍隊+整編進來軍隊的攻擊力
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
 
        foreach ($this->armies as $army) {
            $ret += $army->bombardStrength();
        }
        return $ret;
    }
}
 */


/* 如果還有其他func, 例如計算整體防禦力、計算整體移動距離等，我們就要對他們一一做修改，
 * 如果現在客戶除了軍隊外，還有運兵船這樣的組合戰鬥單元的話....
 */





abstract class Unit 
{
    public function getComposite() {
        return null;
    }
    
    abstract function bombardStrength(); // 輸出戰鬥單位的攻擊力
}

abstract class CompositeUnit extends Unit 
{
    private $units = array();
    
    public function getComposite() {
        return $this;
    }
    
    protected function units() {
        return $this->units;
    }
    
    public function addUnit(Unit $unit) {   // 將一戰鬥單位加入到軍隊群組中
       if (in_Array($unit, $this->units, true)) {
           return;
       }
       $this->units[] = $unit;
    }
    
    public function removeUnit(Unit $unit) { // 將一戰鬥單位從軍隊群組中移除
       //$this->units = array_udiff($this->units, array($unit), function($a, $b){ return ($a === $b)?0:1; }); // PHP 5.3寫法
        $this->units = array_udiff($this->units, array($unit), create_function('$a, $b', 'return ($a === $b)?0:1;'));
    }
}



// 軍隊
class Army extends CompositeUnit
{  
    public function bombardStrength() { // 計算總攻擊力
        $ret = 0;
        foreach ($this->units() as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

// 裝甲運兵車
class TroopCarrier extends CompositeUnit 
{  
    public function addUnit(Unit $unit) {   // 將單位加入
        if ($unit instanceof Cavalry) {
            throw new Exception("Can't get a horse on the vehicle");
        }
        parent::addUnit($unit);
    }
    
    public function bombardStrength() {   
        return 15;
    }
}


// 弓箭手
class Archer extends Unit 
{          
    public function bombardStrength() {
        return 4;
    }
}

// 雷射加農砲
class LaserCannonUnit extends Unit 
{
    public function bombardStrength() {
        return 44;
    }
}

// 騎兵
class Cavalry extends Unit 
{         
    public function bombardStrength() {
        return 15;
    }
}
?>