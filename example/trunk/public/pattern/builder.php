<?php

    include_once '../../class/pattern/builder.php';
    
    $chickenKitMealBuilder = new ChickenKitMealBuilder();
    $beefKitMealBuilder = new BeefKitMealBuilder();
    $mealDirector = new MealDirector();

    $mealDirector->setMealBuilder($chickenKitMealBuilder);
    $chickenKitMeal = $mealDirector->buildMeal();
    $chickenKitMeal->showMeal();

    $mealDirector->setMealBuilder($beefKitMealBuilder);
    $beefKitMeal = $mealDirector->buildMeal();
    $beefKitMeal->showMeal();

?>