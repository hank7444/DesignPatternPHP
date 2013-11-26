<?php
/*
 * 簡單工廠模式舉例
 * 如果有同樣製作流程，但實作內容不同，可用簡單工廠，
 * 但是如果這邊我們多一個類別，為機場，負責建造飛機，而建造飛機會多一個工序時，簡單工廠就不適用，
 * 這時候就要用工廠模式(Factory)來處理。
 */


// 簡單建築物工廠
class SimpleBuildFactory 
{
   public static function createUnit($type) {
        switch($type) {
            case "solider":
                return new Solider();
                break;
            
            case "worker":
                return new Worker();
                break;
        }
    }
}

// 生產中心
class CreateBuildCenter 
{
    public function outputUnit($type) {
        $unit =  SimpleBuildFactory::createUnit($type); // 把會變動的部份抽離出來，變成簡單工廠
        
        $unit->getMaterial();
        $unit->train();
        $unit->create();
        
        return $unit;
    }
}


// 抽象單位
abstract class Unit
{
   public abstract function getMaterial(); // 取得材料
   public abstract function train();       // 訓練
   public abstract function create();      // 產生
}

// 工人
class Worker extends Unit
{
    public function getMaterial() {
        echo "使用了50單位的水晶<br/>";
    }
    
    public function train() {
        echo "訓練時間10秒<br/>";
    }
    
    
    public function create() {
        echo "I am a Worker, I am ready to work!<br/><br/>";
    }
}

// 士兵
class Solider extends Unit
{
    public function getMaterial() {
        echo "使用了50單位的水晶、10單位的瓦斯<br/>";
    }
    
    public function train() {
        echo "訓練時間20秒<br/>";
    }
    
    public function create() {
        echo "I am a Solider, Waiting for your order!<br/><br/>";
    }
}


?>