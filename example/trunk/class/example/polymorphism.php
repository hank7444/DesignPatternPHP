<?php

// 第一種:沒用到繼承，只是很單純使用別的類別方法來處理事情，不是多型
/*
class Shape
{
    function draw($temp){
        $temp->draw();
    }
}

class Circle
{
    function draw(){
        echo "畫圓圈<br/>";
    }
}

class Rectangle
{
    function draw(){
        echo "畫長方形<br/>";
    }
}
*/

// 第二種:也是一樣沒用到繼承，只不過採用呼叫 shape 的靜態方法，使物件在初始化時就開始動作。
/*
class Shape
{
    static function draw($temp){
        $temp->draw();
    }
}

class Circle
{
    function __construct() {
        shape::draw($this);
    }
    
    function draw(){
        echo "畫圓圈<br/>";
    }
}

class Rectangle
{
    function __construct() {
        shape::draw($this);
    }
    
    function draw(){
        echo "畫長方形<br/>";
    }
} 
*/  

abstract class Shape
{
    private $draw;
    
    function setDraw($draw) {
        $this->draw = $draw;
    }
    
    function getDraw() {
        return $this->draw;
    }
}

class Circle extends Shape
{
    function __construct() {
        $this->setDraw('畫圈圈');
    }
}

class Rectangle extends Shape
{
    function __construct() {
        $this->setDraw('畫長方形');
    }
}

class Drawer
{
    private $shapes = array();
    
    function addShape(Shape $shape) {
        array_push($this->shapes, $shape);
    }
    
    function drawAllShapes() {
        foreach($this->shapes as $shape) {
            echo $shape->getDraw() . '<br/>';
        }
    }
}


?>
