<?php

abstract class Animal
{ 
    private $age;
    
    public abstract function getOwned();

    protected function __construct($age) {
        $this->age = $age;
    }

    public function getAge(){
        return $this->age;
    }
}

interface Insurable 
{
    public function getValue();
}

// 繼承至Animal
class Shark extends Animal 
{
    private $speed; // 游泳速度
    
    public function __construct($speed,$age) {
        parent::__construct($age);
        $this->speed = $speed;
    }
    
    public function getSpeed() {
        return $this->speed;
    }

    // 實作自abstract class繼承來的method
    public function getOwned() {  
        return ("getOwned Shark String");
    }
}

// 繼承至Animal、定義了Insurable介面
class Pet extends Animal implements Insurable 
{
    private $name;
    
    public function __construct($name,$age) {
        parent::__construct($age);
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

    // 實作自abstract class繼承來的method
    public function getOwned() {  
        return ("getOwned Pet String");
    }
    
    // 實作自Interface定義的method
    public function getValue() {   
        return ("getValue Pet String");
    }
}

// 繼承至Pet，同時也繼承了Pet實作getValue()的部分，
// 等於也繼承了Insurable Interface
class Human extends Pet 
{ 
    private $money;
    
    public function __construct($money,$name,$age) {
        parent::__construct($name, $age);
        $this->money = $money;
    }
    
    public function getMoney() {
        return $this->money;
    }

    // 實作自abstract class繼承來的method
    public function getOwned() {  
        return ("getOwned Human String");
    }
}

// 定義了Insurable介面
class House implements Insurable 
{
    // 實作自Interface定義的method
    public function getValue() { 
       return ("getValue House String");
    }

}


abstract class Reader
{
    private $items = array();
    
    public function getItems() {
        return $this->items;
    }
    
    public function setItem($item) {
        array_push($this->items, $item);
    }
    
    public abstract function printItems();
}



class InsurableReader extends Reader
{
    public function addItem(Insurable $item) {
        parent::setItem($item);
    }
    
    public function printItems() {
        foreach (parent::getItems() as $item) {
            echo 'getValue():' . $item->getValue() . '<br/>';
        }
    }
}

class AnimalReader extends Reader
{
    public function addItem(Animal $item) {
       parent::setItem($item);
    }

    public function printItems() {
        foreach(parent::getItems() as $item) {
            echo 'getOwned():' . $item->getOwned() . '<br/>';
        }
    }
}
?>