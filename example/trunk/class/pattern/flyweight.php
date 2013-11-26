<?php


// 文字編輯器反模式
class Character 
{
    private $char = null;
    private $size = 12;
    private $color = "black";
    private $posX = 0;
    private $posY = 0;

    public function __construct($char, $size, $color, $posX, $posY) {
        $this->char = $char;
        $this->size = $size;
        $this->color = $color;
        $this->posX = $posX;
        $this->posY = $posY;
    }

    public function showChar() {
        echo $this->char . " size:" . $this->size . " color:" . $this->color 
                         . " (" . $this->posX . "," . $this->posY . ") <br>";
    }
}


// Flyweight
interface Flyweight 
{  
    // 設置內外狀態關係連結的方法
    public function showChar($size, $color, $posX, $posY);  
}  
  
// ConcreteFlyweight
class Character implements Flyweight 
{  
    private $char = null; // intrinsicState
    public function __construct($char) {  
        $this->char = $char;  
    }  

    // Operation
    public function showChar($size, $color, $posX, $posY) {
        echo $this->char . " size:" . $size . " color:" . $color 
                         . " (" . $posX . "," . $posY . ") <br>";
    }
  
}  

class FlyweightFactory 
{  
    private $flyweights;  
  
    public function __construct() {  
        $this->flyweights = array();  
    }  
  
    public function getFlyweight($char) {  
        if (isset($this->flyweights[$char])) {  
            return $this->flyweights[$char];  
        } else {  
            return $this->flyweights[$char] = new Character($char);  
        }  
    }  
}  



/*
// Flyweight
abstract class Flyweight 
{  
    abstract public function operation($extrinasicState);  
}  
  
// ConcreteFlyweight
class ConcreteFlyweight extends Flyweight 
{  
    private $intrinsicState = null;  
    public function __construct($intrinsicState) {  
        $this->intrinsicState = $intrinsicState;  
    }  
  
    public function operation($extrinasicState) {  
        echo 'ConcreteFlyweight operation, Intrinsic State = ' . $this->intrinsicState  
        . ' Extrinsic State = ' . $extrinasicState . '<br />';  
    }  
}  


class FlyweightFactory 
{  
    private $flyweights;  
  
    public function __construct() {  
        $this->flyweights = array();  
    }  
  
    public function getFlyweight($state) {  
        if (isset($this->flyweights[$state])) {  
            return $this->flyweights[$state];  
        } else {  
            return $this->flyweights[$state] = new ConcreteFlyweight($state);  
        }  
    }  
}  


// UnsharedConcreteFlyweight
class UnsharedConcreteFlyweight extends Flyweight 
{  
    private $flyweights;  
    public function __construct() {  
        $this->flyweights = array();  
    }  
  
    public function operation($state) {  
        foreach ($this->flyweights as $flyweight) {  
            $flyweight->operation($state);  
        }  
    }  
  
    public function add($state, Flyweight $flyweight) {  
        $this->flyweights[$state] = $flyweight;  
    }  
}  
  

class FlyweightFactory 
{  
    private $flyweights;  
    public function __construct() {  
        $this->flyweights = array();  
    }  
  
    public function getFlyweight($state) {  

        if (is_array($state)) { // Unshared  

            $uFlyweight = new UnsharedConcreteFlyweight();  
  
            foreach ($state as $row) {  
                $uFlyweight->add($row, $this->getFlyweight($row));  
            }  

            return $uFlyweight;  

        } else if (is_string($state)) {  

            if (isset($this->_flyweights[$state])) {  
                return $this->_flyweights[$state];  
            } else {  
                return $this->_flyweights[$state] = new ConcreteFlyweight($state);  
            }  

        } else {  
            return null;  
        }  
    }  
}  
*/


?>