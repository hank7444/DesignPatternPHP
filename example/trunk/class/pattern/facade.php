<?php
/*
// 加法模組
class Adder 
{
    public function add($a, $b) {
        return $a + $b;
    }
}

// 減法模組
class Subtractor 
{
    public function subtract($a, $b) {
        return $a - $b;
    }
}

// 乘法模組
class Multiplier 
{
    public function multiply($a, $b) {
        return $a * $b;
    }
}

// 除法模組
class Divider  
{
    public function divide($a, $b) {
        if ($b == 0) {
            throw new Exception("Division by zero.");
        }
        return $a / $b;
    }
}
*/
/*
// Facede
class CalculatorFacade
{
    private $_addr;
    private $_subtractor;
    private $_multiplier;
    private $_divider;
    
    public function __construct() {
        $this->_adder = new Adder();
        $this->_subtractor = new Subtractor();
        $this->_multiplier = new Multiplier();
        $this->_divider = new Divider();
    }

    public function calculate($expression) {
        list($a, $operator, $b) = explode(" ", $expression);

        // eliminating switch constructs is not in the intent of this pattern
        switch ($operator) {
            case '+':
                return $this->_adder->add($a, $b);
                break;
            case '-':
                return $this->_subtractor->subtract($a, $b);
                break;
            case '*':
                return $this->_multiplier->multiply($a, $b);
                break;
            case '/':
                return $this->_divider->divide($a, $b);
                break;
        }
    }
}
*/

// 收音機與聲音控制器
class Tuner 
{   
    private $amplifier;
    private $description;
    private $frequency;
 
    public function __construct(Amplifier $amplifier, $description) {
        $this->description = $description;
    }
 
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
 
    public function off() {
        echo($this->description . " off");
        echo("<br />");
    }
 
    public function setFrequency($frequency) {
        echo($this->description . " setting frequency to " . $frequency);
        echo("<br />");
        $this->frequency = $frequency;
    }
 
    public function setAm() {
        echo($this->description . " setting AM mode");
        echo("<br />");
    }
 
    public function setFm() {
        echo($this->description . " setting FM mode");
        echo("<br />");
    }
}

// 戲院燈光組
class TheaterLights 
{   
    private $description;
 
    public function __construct($description) {
        $this->description = $description;
    }
 
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
 
    public function off() {
        echo($this->description . " off");
        echo("<br />");
    }
 
    public function dim($level) {
        echo($this->description . " dimming to " . $level . "%");
        echo("<br />");
    }
}
 

class CDPlayer
{
    private $amplifier;
    private $description;
    private $currentTrack;
    private $title;
 
    public function __construct(Amplifier $amplifier, $description) {
        $this->amplifier = $amplifier;
        $this->description = $description;
    }
     
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
     
    public function off() { 
        echo($this->description . " off");
        echo("<br />");    
         
    }
     
    public function eject() {
        $this->title = null;
        echo($this->description . " eject");
        echo("<br />");
    }
     
    public function play($titleOrTrack) {
        if (is_string($titleOrTrack)) {
            $this->title = $titleOrTrack;
            $this->currentTrack = 0;
            echo($this->description . " playing " . $this->title);
            echo("<br />");
        } else {
            if($titleOrTrack == null) {
                echo($this->description . " can't play track " . $this->currentTrack . ", no cd inserted");
                echo("<br />");
            } else {
                $this->currentTrack = $titleOrTrack;
                echo($this->description . " playing track " . $this->currentTrack);
                echo("<br />");
            }
        }   
    }
     
    public function stop() {
        $this->currentTrack = 0;
        echo($this->description . " stopped");
        echo("<br />");
    }
     
    public function pause(){
        echo($this->description . " paused " . $this->title);
        echo("<br />");
    }
     
    public function __toString() {
        return $this->description;
    }
}

// DVD播放機
class DVDPlayer {   
 
    private $amplifier;
    private $description;
    private $currentTrack;
    private $movie;
 
    public function __construct($description, Amplifier $amplifier) {
        $this->amplifier = $amplifier;
        $this->description = $description;
    }
 
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
 
    public function off() {
        echo($this->description . " off");
        echo("<br />");
    }
 
    public function eject() {
        $this->movie = null;
        echo($this->description . " eject");
        echo("<br />");
    }
 
    public function play($movieOrTrack) {
        if (is_string($movieOrTrack)) {
            $this->movie = $movieOrTrack;
            $this->currentTrack = 0;
            echo($this->description . " playing " . $this->movie);
        } else {
            if ($this->movie == null) {
                echo($this->description . " can't play track " . $movieOrTrack . " no dvd inserted");
            } else {
                $this->currentTrack = $movieOrTrack;
                echo(description . " playing track " . $this->currentTrack . " of " . $this->movie);
            }
        }
    }
 
    public function stop() {
        $this->currentTrack = 0;
        echo($this->description . " stopped");
        echo("<br />");
    }
 
    public function pause() {
        echo($this->description . " paused " . $this->movie);
        echo("<br />");
    }
 
    public function setTwoChannelAudio() {
        echo($this->description . " set two channel audio");
        echo("<br />");
    }
 
    public function setSurroundAudio() {
        echo($this->description . " set surround audio");
        echo("<br />");
    }
 
    public function __toString() {
        return $this->description;
    }
}




// 螢幕
class Screen 
{  
    private $description;
 
    public function __construct($description) {
        $this->description = $description;
    }
 
    public function up() {
        echo($this->description . " going up");
        echo("<br />");
    }
 
    public function down() {
        echo($this->description . " going down");
        echo("<br />");
    }
}


// 投影機
class Projector 
{   
    private $description;
    private $dvdPlayer;
 
    public function __construct($description, DVDPlayer $dvdPlayer) {
        $this->description = $description;
        $this->dvdPlayer = $dvdPlayer;
    }
 
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
 
    public function off() {
        echo($this->description . " off");
        echo("<br />");
    }
 
    public function wideScreenMode() {
        echo($this->description . " in widescreen mode (16x9 aspect ratio)");
        echo("<br />");
    }
 
    public function tvMode() {
        echo($this->description . " in tv mode (4x3 aspect ratio)");
        echo("<br />");
    }
 
}



// 音響擴大機
class Amplifier
{   
    private $tuner;
    private $dvd;
    private $cd;
    private $description;
     
    public function __construct($description) {
        $this->description = $description;
    }
     
    public function on() {
        echo($this->description . " on");
        echo("<br />");
    }
     
    public function off() {
        echo($this->description . " off");
        echo("<br />");
    }
     
    public function setCD(CDPlayer $cd) {
        echo($this->description . " setting CD player to " . $cd);
        echo("<br />");
        $this->cd = $cd;
    }
     
    public function setDVD(DVDPlayer $dvd) {
        echo($this->description . " setting DVD player to " . $dvd);
        echo("<br />");
        $this->dvd = $dvd;
    }
     
    public function setStereoSound() {
        echo($this->description . "  stereo mode on");
        echo("<br />");
    }
     
    public function setSurroundSound() {
        echo($this->description . " surround sound on (5 speakers, 1 subwoofer)");
        echo("<br />");
    }
     
    public function setTuner(Tuner $tuner) {
        echo($this->description . " setting tuner to " . $this->dvd);
        echo("<br />");
        $this->tuner = $tuner;
    }
     
     public function setVolume($volume) {
        echo($this->description . " setting volume to " . $volume);
        echo("<br />");
    }
}



class HomeTheaterFacade 
{
    private $amplifier;
    private $tuner;
    private $dvd;
    private $cd;
    private $projector;
    private $lights;
    private $screen;
 
    public function __construct(Amplifier $amplifier, Tuner $tuner, DVDPlayer $dvd, CDPlayer $cd, Projector $projector, Screen $screen, TheaterLights $lights) {
        $this->amplifier = $amplifier;
        $this->tuner = $tuner;
        $this->dvd = $dvd;
        $this->cd = $cd;
        $this->projector = $projector;
        $this->screen = $screen;
        $this->lights = $lights;
    }
 
    public function watchMovie($movie) {
        echo "Get ready to watch a movie...<br/>";
        $this->lights->on();
        $this->lights->dim(10);
        $this->screen->down();
        $this->projector->on();
        $this->projector->wideScreenMode();
        $this->amplifier->on();
        $this->amplifier->setDVD($this->dvd);
        $this->amplifier->setSurroundSound();
        $this->amplifier->setVolume(5);
        $this->dvd->on();
        $this->dvd->play($movie);
    }
}

?>
