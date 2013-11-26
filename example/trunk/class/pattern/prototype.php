<?php


// 模擬Prototype裡面的子物件
class SubObject 
{
    static $instances = 0;
    public $instance;
    public $value;

    public function __construct($value) {
        $this->instance = ++self::$instances;
        $this->value = $value;
    }
    public function __clone() {
        $this->instance = ++self::$instances;
    }

    public function showValue() {
        return $this->value . "<br>";
    }
}


// Prototype
abstract class BookPrototype
{
    public $subObject1;
    public $subObject2;
    public $title;
    public $topic;

    public function __construct($obj1, $obj2, $title) {
        $this->subObject1 = $obj1;
        $this->subObject2 = $obj2;
        $this->title = $title;
    } 
    // Deep Clone
    public function __clone() {
        // Force a copy of this->object, otherwise it will point to same object.
        $this->subObject1 = clone $this->subObject1;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function show() {
        echo $this->topic . " " . $this->title . "<br>" .
             "object1 Value: " . $this->subObject1->showValue() .
             "object2 Value: " . $this->subObject2->showValue();
    }
}


// ConcretePrototype
class NovelPrototype extends BookPrototype
{
    public function __construct($obj1, $obj2, $title) {
        parent::__construct($obj1, $obj2, $title);
        $this->topic = "Novel";
    }

}

// ConcretePrototype
class ReferenceBookPrototype extends BookPrototype
{
    public function __construct($obj1, $obj2, $title) {
        parent::__construct($obj1, $obj2, $title);
        $this->topic = "ReferenceBook";
    }

}




?>