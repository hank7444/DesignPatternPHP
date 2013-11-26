<?php

// Product
class Meal
{
    private $food; // 主食
    private $drink; // 飲料
    private $dessert; // 點心

    public function setFood($food) {
        $this->food = $food;
    }

    public function setDrink($drink) {
        $this->drink = $drink;
    }

    public function setDessert($dessert) {
        $this->dessert = $dessert;
    }

    public function showMeal() {
        echo $this->food . ", " . $this->drink . ", " . $this->dessert . "<br>";
    }
}

// Builder
abstract class MealBuilder 
{
    protected $meal = null;

    public function __construct() {
        $this->meal = new Meal();
    }

    public abstract function buildFood();
    public abstract function buildDrink();
    public abstract function buildDessert();
    public function getMeal() {
        return $this->meal;
    }
} 

// ConcreteBuilder 
class ChickenKitMealBuilder extends MealBuilder
{    

    public function buildFood() {
        $this->meal->setFood("一個雞腿堡");
    }

    public function buildDrink() {
        $this->meal->setDrink("一杯可樂");
    }

    public function buildDessert() {
        $this->meal->setDessert("一包薯條");
    }
}

// ConcreteBuilder
class BeefKitMealBuilder extends MealBuilder
{
    public function buildFood() {
        $this->meal->setFood("一個牛肉堡");
    }

    public function buildDrink() {
        $this->meal->setDrink("一杯紅茶");
    }

    public function buildDessert() {
        $this->meal->setDessert("一個蘋果派");
    }
}

// Director
class MealDirector
{
    private $mealBuilder;

    public function setMealBuilder(MealBuilder $mealBuilder) {
        $this->mealBuilder = $mealBuilder;
    }

    public function buildMeal() {
        $this->mealBuilder->buildFood();
        $this->mealBuilder->buildDrink();
        $this->mealBuilder->buildDessert();

        return $this->mealBuilder->getMeal();

    }
}
?>