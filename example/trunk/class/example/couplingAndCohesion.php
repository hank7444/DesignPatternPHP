<?php

class Circle 
{
    public $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
}

class Square
{
    public $side;
    
    public function __construct($side) {
        $this->side = $side;
    }
}



class Lister
{
    public $items = array();
    
    public function addItem($item) {
        array_push($this->items, $item);
    }
 
    public function out() {

        echo "+———-+———–+———+<br/>
              |  Type    | parameter |  value  |<br/>
              +———-+———–+———+<br/>";
                
        for ($i = 0, $s = sizeof($this->items); $i < $s; $i++) {
            
                // 判斷是Circle還是Square
                if ($this->items[$i] instanceof Circle) {
                        echo "|  Circle  |  radius    |  " . sprintf('%5.2f', $this->items[$i]->radius) . "  |<br/>";
                } else {
                        echo "|  Square  |  side      |  " . sprintf('%5.2f', $this->items[$i]->side) . "  |<br/>";
                }
                echo "+———-+———–+———+<br/>";
        }
   }
}


// 如果增加其他形狀...

/*
class Circle 
{
    public $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
}

class Square
{
    public $side;
    
    public function __construct($side) {
        $this->side = $side;
    }
}

class Star
{
    public $angle;
    
    public function __construct($angle) {
        $this->angle = $angle;
    }
}

class Diamond
{
    public $diam;
            
    public function __construct($diam) {
        $this->diam = $diam;
    }
}


class Lister
{
    public $items = array();
    
    public function addItem($item) {
        array_push($this->items, $item);
    }
 
    public function out() {

        echo "+———-+———–+———+<br/>
              |  Type    | parameter |  value  |<br/>
              +———-+———–+———+<br/>";
                
        for ($i = 0, $s = sizeof($this->items); $i < $s; $i++) {
            
                //判斷是Circle還是Square
                if ($this->items[$i] instanceof Circle){
                    echo "|  Circle  |  radius    |  " . sprintf('%5.2f', $this->items[$i]->radius) . "  |<br/>";
                } else if ($this->items[$i] instanceof Square){
                    echo "|  Square  |  side      |  " . sprintf('%5.2f', $this->items[$i]->side) . "  |<br/>";
                } else if ($this->items[$i] instanceof Star){
                    echo "|  Star  |  angle       |  " . sprintf('%5.2f', $this->items[$i]->side) . "  |<br/>";
                } else {
                    echo "|  Diamond  |  diam     |  " . sprintf('%5.2f', $this->items[$i]->side) . "  |<br/>";
                }
                
                echo "+———-+———–+———+<br/>";
        }
   }
}
*/



//程式碼重構

abstract class Shape 
{
    private $value;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public abstract function out();
}

class Circle extends Shape 
{  
    public function out(){
          echo "|  Circle  |  radius   |  " . sprintf('%5.2f', $this->getValue()) . "  |<br/>";
    }
}

class Square extends Shape 
{
    public function out() {
        echo "|  Square  |  side     |  " . sprintf('%5.2f', $this->getValue()) . "  |<br/>";
    }
}


class Lister
{
    public $items = array();
    
    public function addItem(Shape $item) {
        array_push($this->items, $item);
    }
        
    public function out() {

        echo "+———-+———–+———+<br/>
              |  Type    | parameter |  value  |<br/>
              +———-+———–+———+<br/>";
                
        for ($i = 0, $s = sizeof($this->items); $i < $s; $i++) {
                $this->items[$i]->out();
                echo "+———-+———–+———+<br/>";
        }
   }
}
?>