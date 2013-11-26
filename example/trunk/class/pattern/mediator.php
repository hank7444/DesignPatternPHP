<?php 

// ConcreteMediator
class  FormMediator 
{
    private $copyBtn = null;
    private $clearBtn = null;
    private $parentList = null;
    private $childList = null;
    
    public function __construct($copyBtn, $clearBtn, $parentList, $childList) {
        $this->copyBtn = $copyBtn;
        $this->clearBtn = $clearBtn;
        $this->parentList = $parentList;
        $this->childList = $childList;
    }

    // 按下複製按鈕
    public function copyBtnClick() { 
        
        if($this->copyBtn->getStatus() == 1)
            echo "複製按鈕按下<br/>";
        else
            echo "複製按鈕目前禁用中<br/>";
    }
    
    // 按下清除按鈕
    public function clearBtnClick() { 
        if ($this->clearBtn->getStatus() == 1) {
            $this->childList->clearData();
            $this->copyBtn->setStatus(2);  // 將Copy按鈕設為disabled
            $this->clearBtn->setStatus(2); // 將Clear按鈕設為disabled
            echo "清除按鈕按下，已將子列表的內容清除!<br/>";
        } else {
            echo "清除按鈕目前禁用中<br/>";
        }
    }

    // 選擇ParentList的項目
    public function selectParentData($count) { 
        $data = $this->parentList->getData();
        $this->childList->setData($data[$count]);
        $this->copyBtn->setStatus(1);  // 將Copy按鈕設為enabled
        $this->clearBtn->setStatus(2); // 將Clear按鈕設為disabled
        
        echo "母項目選擇了" . $count . "，以下是子項目列表:<br/>";
        $this->childList->showData();
        echo "<br/>";
    }

    // 選擇ChildList的項目
    public function selectChildData($count) { 
        $this->clearBtn->setStatus(1); // 將Clear按鈕設為enabled
        echo "子項目選擇了".$count."<br/>";
    } 
}


// Colleague
abstract class Colleague 
{
    protected $mediator = null;
    protected $name = "";
    protected $status = 2; //1:enabled. 2:disabled


    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setMediator(FormMediator $mediator) {
        $this->mediator = $mediator;
    }
    
    abstract public function execute();
}


class CopyButton extends Colleague 
{
    public function execute() {
        $this->mediator->copyBtnClick();
    }
}

class ClearButton extends Colleague 
{
    public function execute() {
        $this->mediator->clearBtnClick();
    }
}

abstract class ListBox
{
    protected $mediator = null;
    protected $list = array();
    
    public function setMediator(FormMediator $mediator) {
        $this->mediator = $mediator;
    }
    
    public function setData($data) {
        $this->list = $data;
    }
    
    public function getData() {
        return $this->list;
    }
    
    public function showData() {
        print_r($this->list);
    }
    
    public function clearData() {
        $this->list = array();
    }
    
    abstract public function select($count = 0);
}

class ParentListBox extends ListBox
{
    public function select($count = 0) {
        $this->mediator->selectParentData($count);
    }
}

class ChildListBox extends ListBox
{
    public function select($count = 0) {
        $this->mediator->selectChildData($count);
    }
}





?>