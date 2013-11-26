<?php
/*
 * 一個地圖遊戲，有平原，但是我們還要去表達平原上有自然資源和汙染的效果。
 * 
 */

/*
abstract class Tile 
{
    public abstract function getWealthFactor();
}

class Plains extends Tile 
{
    private $wealthfactor = 2;
    
    public function getWealthFactor() {
        return $wealthfactor;
    }
}

// 有鑽石
class DiamondPlains extends Plains 
{
    public function getWealthFactor() {
        parent::getWealthFactor() + 2;
    }
}

// 被汙染
class PollutedPlains extends Plans {
    public function getWealthFactor() {
        parent::getWealthFactor() - 4;
    }
}
*/
/* 如果要表達有鑽石又被汙染的平原...?*/
  

/*********功能定義完全依賴繼承體系會導致類別的數量過多，而且程式碼會重複**********/



abstract class Tile 
{   
    public abstract function getWealthFactor();
}

// 平原
class Plains extends Tile 
{     
    private $wealthfactor = 2;
    
    public function getWealthFactor() {
        return $this->wealthfactor;
    }
}

abstract class TileDecorator extends Tile 
{
    protected $tile;
    
    public function __construct(Tile $tile){
        $this->tile = $tile;
    }
}

// 鑽石裝飾
class DiamondDecorator extends TileDecorator 
{  

    public function getWealthFactor() {
        return $this->tile->getWealthFactor() + 2;
    }
}

// 汙染裝飾
class PollutionDecorator extends TileDecorator 
{  

    public function getWealthFactor() {
        return $this->tile->getWealthFactor() - 4;
    }
}


/*
class RequestHelper{}

abstract class ProcessRequest 
{
    abstract function process(RequestHelper $req);
}

// 具體組件，decorate會包住這個物件，並且賦予decorate的屬性或動作
class MainProcess extends ProcessRequest 
{
    function process(RequestHelper $req) {
        print __CLASS__.": doing somethig usefule with request<br/>";
    }
}

// 抽象裝飾
abstract class DecorateProcess extends ProcessRequest 
{
    protected $processrequest;
    function __construct(ProcessRequest $pr) {
        $this->processrequest = $pr;
    }
}


class LogRequest extends DecorateProcess 
{
    function process(RequestHelper $req) {
        print __CLASS__.": logging request<br/>";
        $this->processrequest->process($req);
    }
}

class AuthenticateRequest extends DecorateProcess 
{
    function process(RequestHelper $req) {
        print __CLASS__ . ": authenticating request<br/>";
        $this->processrequest->process($req);
    }
}

class StructureRequest extends DecorateProcess 
{
    function process(RequestHelper $req){
        print __CLASS__ . ": structuring request data<br/>";
        $this->processrequest->process($req);
    }
}
*/


?>
