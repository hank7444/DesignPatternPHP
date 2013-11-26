<?php

/*
 * 假設Blizzard的Battle.net有個負責處理用戶登入的類別 
 *
 */

/*
class Login 
{
    const LOGIN_USER_UNKNOW = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    const LOGIN_ERROR37 = 4;
    
    private $status = array();
    
    public function handleLogin($pass, $user, $ip) {
        switch(rand(1,4)){
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = true;
                break;
            
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $ret = false;
                break;
            
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $ret = false;
                break;
            
            case 4:
                $this->setStatus(self::LOGIN_ERROR37, $user, $ip);
                $ret = false;
                break;
        }
        return $ret;
        
        // 如果客戶要求你將用戶登入的IP地址記到LOG中..
        Logger::logIP($user, $ip, $this->getStatus());
        
        
        // 如果客戶要求每次登入發生錯誤時，都要寄一封Email到管理員信箱中..
        if (!$ret) {
            Notifier::mailWarning($user, $ip, $this->getStatus());
        }
    }
    
    private function setStatus($status, $user ,$ip) {
        $this->status = array($status, $user, $ip);
    }
    
    public function getStatus() {
        return $this->status;
    }
}

// log紀錄類別
class Logger
{   
    public static function logIP($user, $ip, $status) {
        echo "log user IP address<br/>";
    }
}

// 郵件發送類別
class Notifier
{ 
    public static function mailWarning($user, $ip, $status) {
        echo "mail Warning to admin<br/>";
    }
}
*/


//如果直接在代碼中加入功能，會破壞我們的設計，Login類別很快會跟這些額外的程式碼緊緊地綁在一起，
//最後會走上剪切黏代碼的開發道路..Orz


//Observer的核心是把客戶元素從一個中心類別中分離開來。




interface Observer 
{
    public function update(Subject $subject);
}

// 為了保持Observable接口的通用性，由Observer類別負責保證它們的主體是正確的類型
abstract class LoginObserver implements Observer
{
    private $login;

    public function __construct(Login $login) {
        $this->login = $login;
        $login->attach($this);
    }
    
    public function update(Subject $subject) {
        if ($subject === $this->login) {
            $this->doUpdate($subject);
        }
    }
    
    abstract function doUpdate(Login $login);
}

class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // 發送郵件給系統管理員
            echo __CLASS__ . ": sending mail to sysadmin <br/>";
        }
    }                                            
}

class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        // 紀錄登入log
        echo __CLASS__ . ":add login data to log <br/>";
    }
}

class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        echo __CLASS__ . ":set cookie if IP matches a list <br/>";
    }
}







interface Subject 
{
   public function attach(Observer $observer);
   public function detach(Observer $observer);
   public function notify();
}

class Login implements Subject
{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    const LOGIN_ERROR37 = 4;
    
    private $status = array();
    private $observers;
    
    public function __construct() {
        $this->observers = array();
    }
    
    public function handleLogin($pass, $user, $ip) {
        switch(rand(1,4)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = true;
                break;
            
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $ret = false;
                break;
            
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $ret = false;
                break;
            
            case 4:
                $this->setStatus(self::LOGIN_ERROR37, $user, $ip);
                $ret = false;
                break;
        }
        $this->notify();
        return $ret;
    }
    
    private function setStatus($status, $user ,$ip) {
        $this->status = array($status, $user, $ip);
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function attach(Observer $observer){ // 註冊觀察者
        $this->observers[] = $observer;
    }
    
    public function detach(Observer $observer){ // 解除註冊特定觀察者
        $newobservers = array();
        foreach ($this->observers as $obs) {
            if ($obs !== $observer) {
                $newobservers[] = $obs;
            }
        }
        $this->observers = $newobservers;
    }
    
    public function notify(){  // 發出通知
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }  
}


/*
class Login implements SplSubject
{  
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    const LOGIN_ERROR37 = 4;
    
    private $status = array();
    private $storage;
    
    public function __contstuct() {
        $this->storage = new SplObjectStorage(); // PHP >= 5.3
    }
    
    
    public function handleLogin($pass, $user, $ip) {
        switch(rand(1,4)){
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = true;
                break;
            
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $ret = false;
                break;
            
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $ret = false;
                break;
            
            case 4:
                $this->setStatus(self::LOGIN_ERROR37, $user, $ip);
                $ret = false;
                break;
        }
        $this->notify();
        return $ret;
    }
    
    private function setStatus($status, $user ,$ip) {
        $this->status = array($status, $user, $ip);
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function attach(SplObserver $observer) {
        $this->storage->attach($observer);
    }
    
    public function detach(SplObserver $observer) {
        $this->storage->detach($observer);
    }
    
    public function notify() {
        foreach($this->storage as $obs){
            $obs->update($this);
        }
    }
}


// 為了保持Observable接口的通用性，由Observer類別負責保證它們的主體是正確的類型
abstract class LoginObserver implements SplObserver
{
    private $login;
    public function __construct(Login $login) {
        $this->login = $login;
        $login->attach($this);
    }
    
    public function update(SplSubject $subject) {
        if($subject === $this->login){
            $this->doUpdate($subject);
        }
    }
    
    abstract function doUpdate(Login $login);
}

class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // 發送郵件給系統管理員
            echo __CLASS__.": sending mail to sysadmin <br/>";
        }
    }                                            
}

class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        // 紀錄登入log
        echo __CLASS__.":add login data to log <br/>";
    }
}

class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login) {
        $status = $login->getStatus();
        echo __CLASS__.":set cookie if IP matches a list <br/>";
    }
}
*/
 
?>