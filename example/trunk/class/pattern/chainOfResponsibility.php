<?php 
// 純責任鍊範例

// Handler
abstract class Logger 
{
    protected $handler = null;
    
    public function setSuccessor(logger $handler) {  // 設定責任要傳遞的下家
        $this->handler = $handler;
    }
    
    protected function handleRequest($request) {
         if ($this->handler != null) {
             return $this->handler->handleRequest($request); // 如果要傳遞的下家存在，就將request往下傳，如果下家不存在則拋出處理完的request
         } else {
             return "無法處理此類型的資料!";
         }
    }
}

// ConcreteHandler 資料庫logger
class dbLogger extends Logger  
{
    public function handleRequest($request) { 
        
        if (strpos($request, "db") !== false) {
            return "將db log寫入";
        } else { 
            return parent::handleRequest($request);
        }
    } 
}

// ConcreteHandler Session Logger
class sessionLogger extends Logger 
{
   public function handleRequest($request) { 
       
        if (strpos($request, "session") !== false) {
            return "將session log寫入";
        } else { 
            return parent::handleRequest($request);
        }
    } 
}

// ConcreteHandler Cache Logger
class cacheLogger extends Logger 
{
    public function handleRequest($request) {
        
        if (strpos($request, "cache") !== false) {
            return "cache log寫入";
        } else { 
            return parent::handleRequest($request);
        }
    }
}


// 不純責任鍊範例

// Handler 
abstract class DirtyWordFilter 
{ 
    protected $keyWord = array();
    protected $handler = null; 
    public function setSuccessor(DirtyWordFilter $handler) { // 設定責任要傳遞的下家
        $this->handler = $handler; 
    } 
    protected function handleRequest($request) {
        if($this->handler != null) {   // 如果要傳遞的下家存在，就將request往下傳，如果下家不存在則拋出處理完的request
            return $this->handler->handleRequest($request);
        } else { 
            return $request; 
        }
    }
} 

// ConcreteHandler
class ChineseDirtyWordFilter extends DirtyWordFilter  
{ 
    public function __construct() {
         $this->keyWord = array(
          "豬頭", "笨蛋", "白癡", "三八", "王八蛋"  
        );
    }
    
    public function handleRequest($request) { 
        
        foreach($this->keyWord as $row) {
            $request = str_replace($row, "***", $request);
        }
        return parent::handleRequest($request);
    } 
}

// ConcreteHandler
class EnglishDirtyWordFilter extends DirtyWordFilter 
{
    public function __construct() {
         $this->keyWord = array(
          "son of bitch", "idiot", "asshole", "bullshit"  
        );
    }
    
    public function handleRequest($request) { 
        
        foreach($this->keyWord as $row) {
            $request = str_replace($row, "???", $request);
        }
        return parent::handleRequest($request);
    }
}

?>