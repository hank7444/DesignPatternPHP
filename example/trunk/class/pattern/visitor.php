<?php


abstract class ArmyVisitor
{
    abstract function visit(Unit $node);
    
    public function visitArcher(Archer $node) {
        $this->visit($node);
    }
    
    public function visitCavalry(Cavalry $node) {
        $this->visit($node);
    }
    
    public function visitLaserCannonUnit(LaserCannonUnit $node) {
        $this->visit($node);
    }
    
    public function visitTroopCarrierUnit(TroopCarrierUnit $node) {
        $this->visit($node);
    }
    
    public function visitArmy(Army $node) {
        $this->visit($node);
    }
}

class TextDumpArmyVisitor extends ArmyVisitor
{
    private $text = "";
    
    public function visit(Unit $node) {
        $ret = "";
        $pad = $node->getDepth();
        $ret .= "({$pad})";
        $ret .= get_class($node) . " : ";
        $ret .= "bombard: " . $node->bombardStrength() . "<br/>";
        $this->text .= $ret;
    }
    
    public function getText() {
        return $this->text;
    }
}

class TaxCollectionVisitor extends ArmyVisitor
{
    private $due = 0;
    private $report = "";
    
    public function visit(Unit $node) {
        $this->levy($node, 1);
    }
    
    public function visitArcher(Archer $node) {
        $this->levy($node, 2);
    }
    
    public function visitCavalry(Cavalry $node) {
        $this->levy($node, 3);
    }
    
    public function visitTroopCarrierUnit(TroopCarrierUnit $node) {
        $this->levy($node, 5);
    }
    
    private function levy(Unit $unit, $amount) {
        $this->report .= "Tax levied for " . get_class($unit);
        $this->report .= ": " . $amount . "<br/>";
        $this->due += $amount;
    }
    
    public function getReport() {
        return $this->report;
    }
    
    public function getTax() {
        return $this->due;
    }
}



abstract class Unit 
{
    private $depth = 0;
    
    public function getComposite() {
        return null;
    }
    
    abstract function bombardStrength();
    
    public function accept(ArmyVisitor $visitor) {
        $method = "visit" . get_class($this);
        $visitor->$method($this);
    }
    
    protected function setDepth($depth) {
        $this->depth=$depth;
    }
    
    public function getDepth() {
        return $this->depth;
    }
}

abstract class CompositeUnit extends Unit {
    private $units = array();
    
    public function getComposite() {
        return $this;
    }
    
    protected function units() {
        return $this->units;
    }
    
    public function addUnit(Unit $unit) {
       if (in_Array($unit, $this->units, true)) {
           return;
       }
       
       $unit->setDepth($this->getDepth() + 1);
       $this->units[] = $unit;
    }
    
    public function removeUnit(Unit $unit) {
       //$this->units = array_udiff($this->units, array($unit), function($a, $b){ return ($a === $b)?0:1; }); //PHP 5.3寫法
        $this->units = array_udiff($this->units, array($unit), create_function('$a, $b', 'return ($a === $b)?0:1;'));
    }

    public function accept(ArmyVisitor $visitor) {
        parent::accept($visitor);
        foreach($this->units as $thisunit){
            $thisunit->accept($visitor);
        }
    }
}




class Army extends CompositeUnit 
{
    public function bombardStrength(){
        $ret = 0;
        foreach ($this->units() as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

class TroopCarrier extends CompositeUnit 
{
    public function addUnit(Unit $unit) {   // 將單位加入
        
        if ($unit instanceof Cavalry) {
            throw new Exception("Can't get a horse on the vehicle");
        }
        parent::addUnit($unit);
    }
    
    public function bombardStrength() {   // 計算總攻擊力
        return 0;
    }
}


// 弓箭手
class Archer extends Unit {          
    public function bombardStrength() {
        return 4;
    }
}

// 雷射加農砲
class LaserCannonUnit extends Unit { 
    public function bombardStrength() {
        return 44;
    }
}

// 騎兵
class Cavalry extends Unit {         
    public function bombardStrength() {
        return 15;
    }
}





?>