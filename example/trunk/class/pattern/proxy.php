<?php

// Subject
interface AbstractPermission
{
    public function modifyUserInfo();
    public function viewNote();
    public function publishNote();
    public function modifyNote();
    public function setLevel($level);
}

// RealSubject
class RealPermission implements AbstractPermission
{
    private $level = 0;

    public function modifyUserInfo() {
        echo "修改用戶信息! <br>";
    }

    public function viewNote() {
        echo "查看內容! <br>";
    }

    public function publishNote() {
        echo "發佈新訊息! <br>";
    }

    public function modifyNote() {
        echo "修改發佈訊息內容! <br>";
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function getLevel() {
        return $this->level;
    }
}

// Proxy
class PermissionProxy implements AbstractPermission
{
    private $realPermission =  null;

    public function __construct() {
        $this->realPermission = new RealPermission();
    }

    public function modifyUserInfo() {

        if ($this->realPermission->getLevel() == 0) {
            echo "對不起，你沒有該權限! <br>";
        } else {
            echo "開始修改用戶權限! <br>";
        }
    }

    public function viewNote() {
        $this->realPermission->viewNote();
    }

    public function publishNote() {
        if ($this->realPermission->getLevel() == 0) {
            echo "對不起，你沒有權限發佈新訊息! <br>";
        } else {
            $this->realPermission->publishNote();
        }
    }

    public function modifyNote() {
        if ($this->realPermission->getLevel() == 0) {
            echo "對不起，你沒有權限修改訊息！ <br>";
        } else {
            $this->realPermission->modifyNote();
        }

    }

    public function setLevel($level) {
        $this->realPermission->setLevel($level);
    }

}
?>