<?php
// 反面範例
/*
interface AngryBird 
{ 
    
    public function play();
}


class AndroidAngryBirdNormal implements AngryBird 
{
    public function play() {
        echo "您開始玩Android平台的AngryBird普通版本<br>";
    }

}

class AndroidAngryBirdSpace implements AngryBird
{
    public function play() {
        echo "您開始玩Android平台的AngryBird宇宙版本<br>";
    }
}

class AndroidAngryBirdRio implements AngryBird
{
    public function play() {
        echo "您開始玩Android平台的AngryBirdRio版本<br>";
    }
}



class IOSAngryBirdNormal implements AngryBird
{
    public function play() {
        echo "您開始玩iOS平台的AngryBird普通版本<br>";
    }
}

class IOSAngryBirdSpace implements AngryBird
{
    public function play() {
        echo "您開始玩iOS平台的AngryBird宇宙版本<br>";
    }
}


class IOSAngryBirdRio implements AngryBird
{
    public function play() {
        echo "您開始玩iOS平台的AngryBirdRio版本<br>";
    }
}
*/

// implementor
interface Platform 
{
    public function control();
}

// concrete implementor
class AndroidPlatform implements Platform
{
    public function control() {
        return "Android";
    }
}

// concrete implementor
class IOSPlatform implements Platform
{
    public function control() {
        return "IOS";
    }
}


// abstraction
abstract class AngryBird 
{
    protected $platform = null;

    public function __construct(Platform $platform) {
        $this->platform = $platform;
    }

    public abstract function play();
}



// refined abstraction
class AngryBirdNormal extends AngryBird
{

    public function play() {
        echo "您開始玩AngryBird普通版本, 平台為:" . $this->platform->control() . "<br>";
    }
}

// refined abstraction
class AngryBirdSpace extends AngryBird
{
    public function play() {
        echo "您開始玩AngryBird宇宙版本, 平台為:" . $this->platform->control() . "<br>";
    }
}

// refined abstraction
class AngryBirdRio extends AngryBird
{
    public function play() {
        echo "您開始玩AngryBirdRio版本, 平台為:" . $this->platform->control() . "<br>";
    }
}

?>