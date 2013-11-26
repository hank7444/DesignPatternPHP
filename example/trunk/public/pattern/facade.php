<?php
    include_once '../../class/pattern/facade.php';

    /*
    $adder = new Adder();
    echo "254 + 113 = " . $adder->add(254, 113) . "<br/>";
    $divider = new Divider();
    echo "256 / 8 = " . $divider->divide(256, 8) . "<br/>";
    
    
    $calculatorFacade = new CalculatorFacade();
    echo "254 + 113 = " . $calculatorFacade->calculate("254 + 113") . "<br/>";
    echo "256 / 8 = " . $calculatorFacade->calculate("256 / 8") . "<br/>";
    */


    $amplifier = new Amplifier("Top-O-Line Amplifier");
    $tuner = new Tuner($amplifier, "Top-O-Line AM/FM Tuner");
    $dvd = new DVDPlayer("Top-O-Line DVD Player", $amplifier);
    $cd = new CDPlayer($amplifier, "Top-O-Line CD Player");
    $projector = new Projector("Top-O-Line Projector", $dvd);
    $lights = new TheaterLights("Theater Ceiling Lights");
    $screen = new Screen("Theater Screen");
    $movie = 'TopGun';


    $homeTheater = new HomeTheaterFacade($amplifier, $tuner, $dvd, $cd, $projector, $screen, $lights);
    $homeTheater->watchMovie($movie);


    /*
    echo "Get ready to watch a movie...<br/>";
    $lights->on();
    $lights->dim(10);
    $screen->down();
    $projector->on();
    $projector->wideScreenMode();
    $amplifier->on();
    $amplifier->setDVD($dvd);
    $amplifier->setSurroundSound();
    $amplifier->setVolume(5);
    $dvd->on();
    $dvd->play($movie);
    */
    
    /*
    echo "Get ready to watch a movie...<br/>";
    $lights->on();
    $lights->dim(10);
    $screen->down();
    $projector->on();
    $projector->wideScreenMode();
    $amplifier->on();
    $amplifier->setDVD($dvd);
    $amplifier->setSurroundSound();
    $amplifier->setVolume(5);
    $dvd->on();
    $dvd->play($movie);
     */
    
    
?>