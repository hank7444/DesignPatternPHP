<?php


abstract class Unit 
{
    abstract function getName();
    
    public function getComposite(){
        return null;
    }
    
    abstract function bombardStrength(); //輸出戰鬥單位的攻擊力
}

// Aggregate
abstract class CompositeUnit extends Unit 
{
    private $units = array();

    public function getName() {

    }
    
    public function getComposite() {
        return $this;
    }
    
    public function units() {
        return $this->units;
    }
    
    public function addUnit(Unit $unit) {   //將一戰鬥單位加入到軍隊群組中
       if(in_Array($unit, $this->units, true)) {
           return;
       }
       $this->units[] = $unit;
    }
    
    public function removeUnit(Unit $unit) { //將一戰鬥單位從軍隊群組中移除
       //$this->units = array_udiff($this->units, array($unit), function($a, $b){ return ($a === $b)?0:1; }); //PHP 5.3寫法
        $this->units = array_udiff($this->units, array($unit), create_function('$a, $b', 'return ($a === $b)?0:1;'));
    }

    public function createIterator() {
        return new CompositeIterator($this);
    }

}



// ConcreteAggregate
class Army extends CompositeUnit 
{ 
    public function getName() {
        echo '軍隊<br>';
    }

    public function bombardStrength() { //計算總攻擊力
        $ret = 0;
        foreach( $this->units() as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

// ConcreteAggregate
class TroopCarrier extends CompositeUnit 
{  
    public function getName() {
        echo '裝甲運兵車<br>';
    }
    
    public function addUnit(Unit $unit) {   //將單位加入
        
        if($unit instanceof Cavalry) {
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
    public function getName() {
        echo '弓箭手<br>';
    }

    public function bombardStrength() {
        return 4;
    }
}

// 雷射加農砲
class LaserCannonUnit extends Unit 
{ 
    public function getName() {
        echo '雷射加農砲<br>';
    }

    public function bombardStrength() {
        return 44;
    }
}

// 騎兵
class Cavalry extends Unit 
{   
    public function getName() {
        echo '騎兵<br>';
    }      

    public function bombardStrength() {
        return 15;
    }
}


// Iterator
interface MyIterator 
{
    public function next();
    public function hasNext();
}

// ConcreteIterator
class CompositeIterator implements MyIterator
{
    protected $units;
    protected $currentIndex = 0;

    public function __construct(CompositeUnit $compositeUnit) {
        $this->units = $compositeUnit->units();
    }

    public function current() {
        return $this->units[$this->currentIndex];
    }

    public function next() {
        if ($this->hasNext()) {
            $component = $this->units[$this->currentIndex];
            $this->currentIndex++;
            return $component;
        } else {
            echo "沒有物件了喔!<br>";
        }
    }

    public function hasNext() {

        if (empty($this->units) || !isset($this->units[$this->currentIndex])) {
            return false;
        } else {
            
            if (count($this->units) > $this->currentIndex) {
                return true;
            } else {
                return null;
            }

        }
    }
}


?>