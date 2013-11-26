<?php

//硬幹的寫法...

/*
class CandyMachine
{
    const STATUS_NO_COIN = 1;  // 沒有硬幣狀態
    const STATUS_HAS_COIN = 2; // 有硬幣狀態
    const STATUS_SOLD = 3;     // 糖果售出狀態
    const STATUS_SOLDOUT = 4;  // 糖果售鑿狀態

    const STATUS_DOUBLE = 5;
    
    private $state;     // 糖果機目前狀態
    private $count = 0; // 糖果數量
    
    // 初始化糖果機與糖果數量
    public function __construct($count) { 
        $this->count = $count;
        
        if ($this->count > 0) {
            $this->state = CandyMachine::STATUS_NO_COIN;
        } else {
            $this->state = CandyMachine::STATUS_SOLDOUT;
        }
        
        echo "初始化糖果機成功，共有" . $count . "顆糖果<br/>";
    }

    // 取得目前剩餘糖果數量
    public function getCount() { 
        return $this->count;
    }
    
    public function setState($state){
        $this->state = $state;
    }
    
    public function getState(){
        return $this->state;
    }
    
    
    public function releaseCandy() {
        if ( $this->count > 0 ) {
            $this->count = $this->count - 1;
            echo "得到一顆糖果，還有有糖果 {$this->count} 顆<br/>";  
        }
    }

    // 插入硬幣
    public function insertCoin() {   
        switch($this->state) {
            case CandyMachine::STATUS_NO_COIN:
                $this->setState(CandyMachine::STATUS_HAS_COIN);
                echo "你插入了一枚硬幣<br/>";
                break;
            
            case CandyMachine::STATUS_HAS_COIN:
                echo "已經有硬幣了，無法插入<br/>";
                break;
            
            case CandyMachine::STATUS_SOLD:
                echo "請稍等，我們正在給你糖果<br/>";
                break;
            
            case CandyMachine::STATUS_SOLDOUT: 
                echo "很抱歉，所有糖果都已售鑿，無法插入<br/>";
                break;
        }
    }

    // 退回硬幣
    public function ejectCoin() {   
        switch($this->state) {
            case CandyMachine::STATUS_NO_COIN:
                echo "你還沒插入硬幣呢!<br/>";
                break;
            
            case CandyMachine::STATUS_HAS_COIN:
                $this->setState(CandyMachine::STATUS_NO_COIN);
                echo "退回硬幣<br/>";
                break;
            
            case CandyMachine::STATUS_SOLD:
                echo "很抱歉，你已經轉動了曲柄，無法退回<br/>";
                break;
            
            case CandyMachine::STATUS_SOLDOUT:
                echo "所有糖果已售鑿，無法插入硬幣，故不退幣<br/>";
                break;
        }
    }

    // 轉動曲柄
    public function turnCrank() {    
        switch($this->state){
            case CandyMachine::STATUS_NO_COIN:
                echo "你還沒插入硬幣，無法轉動曲柄<br/>";
                break;
            
            case CandyMachine::STATUS_HAS_COIN:
                 
                if ($this->count > 0){
                    $this->setState(CandyMachine::STATUS_SOLD);
                    echo "你轉動了曲柄<br/>";
                } else {
                    $this->setState(CandyMachine::STATUS_SOLDOUT);
                    echo "你轉動了曲柄，但是已經沒有糖果了<br/>";
                }
                
                break;
            
            case CandyMachine::STATUS_SOLD:
                echo "很抱歉，你正在轉動曲柄，所以此命令無效<br/>";
                break;
            
            case CandyMachine::STATUS_SOLDOUT: 
                echo "很抱歉，已經沒有糖果了，無法轉動曲柄<br/>";
                break;
        }
    }
    
    // 發放糖果
    public function dispense() {    
        switch($this->state){
            case CandyMachine::STATUS_NO_COIN:
                echo "你還沒插入硬幣，無法發放糖果<br/>";
                break;
            
            case CandyMachine::STATUS_HAS_COIN:
                echo "請先轉動曲柄<br/>";
                break;
            
            case CandyMachine::STATUS_SOLD:
                $this->releaseCandy();
                if($this->count > 0)
                    $this->setState(CandyMachine::STATUS_NO_COIN);
                else {
                    $this->setState(CandyMachine::STATUS_SOLDOUT);
                    echo "没有糖果了.\n";
                }
                break;
            
            case CandyMachine::STATUS_SOLDOUT: 
                echo "很抱歉，已經沒有糖果了，無法發放<br/>";
                break;
        }
    }
}
*/


class CandyMachine
{
    private $noCoinState;
    private $hasCoinState;
    private $soldState;
    private $soldoutState;
    private $doubleState; // 送兩顆糖果狀態
            
    private $state;       // 糖果機目前狀態
    private $count = 0;   // 糖果數量
    
    public function __construct( $count = 0) {
        $this->noCoinState = new NoCoinState($this);
        $this->hasCoinState = new HasCoinState($this);
        $this->soldState = new SoldState($this);
        $this->soldoutState = new SoldoutState($this);
        $this->doubleState = new DoubleState($this);  // 多初始化送兩顆糖果的狀態
        $this->count = $count;
        
        if($this->count > 0) {
            $this->state = $this->noCoinState;
        } else {
            $this->state = $this->soldoutState;
        }
        
        echo "初始化糖果機成功，共有".$count."顆糖果<br/>";
    }
    
    // 取得目前剩餘糖果數量
    public function getCount() { 
        return $this->count;
    }
    
    public function setState(State $state) {
        $this->state = $state;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public function releaseCandy() {
        if ( $this->count > 0 ) {
             $this->count = $this->count - 1;
             echo "得到一顆糖果，还有糖果 {$this->count} 顆<br/>";
        }
    }
    
    public function insertCoin() {
        $this->state->insertCoin();
    }
    
    public function ejectCoin() {
        $this->state->ejectCoin();
    }
    
    public function turnCrank() {
        $this->state->turnCrank();
    }
    
    public function dispense() {
        $this->state->dispense();
    }
    
    public function getNoCoinState () {
        return $this->noCoinState;
    }

    public function getHasCoinState () {
        return $this->hasCoinState;
    }

    public function getSoldOutState () {
        return $this->soldoutState;
    }

    public function getSoldState () {
        return $this->soldState;
    }
    
    public function getDoubleState() {
        return $this->doubleState;
    }
}


// 狀態模式
interface State
{
    public function insertCoin(); // 插入硬幣
    public function ejectCoin();  // 退回硬幣
    public function turnCrank();  // 轉動曲柄
    public function dispense();   // 發放糖果
}

class NoCoinState implements State
{
    private $machine;
    
    public function __construct(CandyMachine $candyMachine) {
        $this->machine = $candyMachine;
    }
    
    public function insertCoin() {
         $this->machine->setState($this->machine->getHasCoinState());
         echo "你插入了一枚硬幣<br/>";
    }
    
    public function ejectCoin() {
         echo "沒插入硬幣，無法退回<br/>";
    }
    
    public function turnCrank() {
        echo "你還沒插入硬幣，無法轉動曲柄<br/>";
    }
    
    public function dispense() {
        echo "你還沒插入硬幣，無法發放糖果<br/>";
    }
}

class HasCoinState implements State
{
    private $machine;
    
    public static function random() { // 亂數計算是否可以獲得兩顆糖果
        if(rand(1,10) == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function __construct(CandyMachine $candyMachine) {
        $this->machine = $candyMachine;
    }
    
    public function insertCoin() {
         echo "已經有硬幣了，無法插入<br/>";
    }
    
    public function ejectCoin() {
        $this->machine->setState($this->machine->getNoCoinState());
        echo "退回硬幣<br/>";
    }
    
    public function turnCrank() {
        if(self::random() == true) {
            $this->machine->setState($this->machine->getSoldState());
        } else {
            $this->machine->setState($this->machine->getDoubleState()); // 變為兩顆糖果狀態
        }     
        echo "你轉動了曲柄<br/>";
    }
    
    public function dispense() {
        echo "你還沒轉動曲柄，無法發放糖果<br/>";
    }
}


class SoldState implements State
{
    private $machine;
    
    public function __construct(CandyMachine $candyMachine) {
        $this->machine = $candyMachine;
    }
    
    public function insertCoin() {
         echo "請稍等，我們正在給你糖果<br/>";
    }
    
    public function ejectCoin() {
         echo "很抱歉，你已經轉動了曲柄，無法退回<br/>";
    }
    
    public function turnCrank() {
         echo "很抱歉，你已經轉動曲柄，不能再轉了<br/>";
    }
    
    public function dispense() {
        $this->machine->releaseCandy();
        if ( $this->machine->getCount() > 0 ) {
            $this->machine->setState($this->machine->getNoCoinState());
        } else {
            echo "没有糖果了<br/>";
            $this->machine->setState($this->machine->getSoldOutState());
        }
    }
}


class SoldoutState implements State
{
    private $machine;
    
    public function __construct(CandyMachine $candyMachine) {
        $this->machine = $candyMachine;
    }
    
    public function insertCoin() {
         echo "很抱歉，所有糖果都已售鑿，無法插入<br/>";
    }
    
    public function ejectCoin() {
         echo "所有糖果已售鑿，無法插入硬幣，故不退幣<br/>";
    }
    
    public function turnCrank() {
          echo "很抱歉，已經沒有糖果了，無法轉動曲柄<br/>";
    }
    
    public function dispense() {
        echo "很抱歉，已經沒有糖果了，無法發放<br/>";
    }
}

// 兩顆糖果狀態
class DoubleState implements State  
{
    private $machine;
    
    public function __construct(CandyMachine $candyMachine) {
        $this->machine = $candyMachine;
    }
    
    public function insertCoin() {
         echo "請稍等，我們正在給你糖果<br/>";
    }
    
    public function ejectCoin() {
         echo "很抱歉，你已經轉動了曲柄，無法退回<br/>";
    }
    
    public function turnCrank() {
         echo "很抱歉，你已經轉動曲柄，不能再轉了<br/>";
    }
    
    public function dispense() {
        $this->machine->releaseCandy();
        if ( $this->machine->getCount() > 0 ) { 
            
            echo "免費贈送一顆糖果<br/>";
            $this->machine->releaseCandy(); // 如果還有糖果，再發一顆
            
            if ( $this->machine->getCount() > 0 ) 
                 $this->machine->setState( $this->machine->getNoCoinState() );
            else { 
                echo "免費贈送一顆糖果，但是機器裡面没有糖果了<br/>";
                $this->machine->setState( $this->machine->getSoldOutState() );
            }   
        } else {
            echo "没有糖果了<br/>";
            $this->machine->setState( $this->machine->getSoldOutState() );
        }
    }
}
 
?>