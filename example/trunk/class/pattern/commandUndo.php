<?php

/*
 Command模式
 * 
優點:
 
1.降低系统的耦合度。
2.新的命令可以很容易地加入到系统中。
3.可以比较容易地设计一个组合命令。

缺點:
使用命令模式可能会导致某些系统有过多的具体命令类。因为针对每一个命令都需要设计一个具体命令类，因此某些系统可能需要大量具体命令类，这将影响命令模式的使用


使用時間:
1.系统需要将请求调用者和请求接收者解耦，使得调用者和接收者不直接交互。
2.系统需要在不同的时间指定请求、将请求排队和执行请求。
3.系统需要支持命令的撤销(Undo)操作和恢复(Redo)操作。
4.系统需要将一组操作组合在一起，即支持巨集命令。


情境模擬:
 
現在我們要設計簡單的文字編輯器，具有貼上某字串到主文章上，或將主文章上某字串剪掉，並具有Undo, Redo的功能，
該怎麼實作呢?


Undo Redo範例
 */

// Receiver
abstract class TextEditor
{
    public abstract function cut($cutText);
    public abstract function paste($pasteText);
    public abstract function getText();
    public abstract function setText($text);
    protected abstract function showText();
}

// ConcreteReceiver
class DommyWord extends TextEditor
{   
    private $text;
    
    public function __construct($text) {
        $this->text = $text;
    }
    
    public function cut($cutText){      
        $this->text = str_replace($cutText, "", $this->text);
        $this->showText();
    }
    
    public function paste($pasteText) {
        $this->text .= $pasteText;
        $this->showText();
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
        $this->showText();
    }
    
    protected function showText() {
        echo $this->text.'<BR/>';
    }
}




// Command 這邊用abstract class也可以
interface Command 
{  
    public function execute($text);
    public function undo();
    public function redo();
}

// ConcreteCommand
class CutCommand implements Command
{
    private $textEditor;
    private $text = array();     // 原始數據備份陣列
    private $textRedo = array(); // 輸入數據備份陣列
    
    public function __construct(TextEditor $textEditor) {
        $this->textEditor = $textEditor;
    }
    
    public function execute($text) {

        // 備份舊資料
        array_push($this->text, $this->textEditor->getText());
        
        // 裁切資料
        $this->textEditor->cut($text);
    }
    
    public function undo() {
        if (count($this->text) <= 0) {
            return false;
        }
        $text = array_pop($this->text);
        array_push($this->textRedo, $this->textEditor->getText());
        $this->textEditor->setText($text);
    }
    
    public function redo() {
        if (count($this->textRedo) <= 0) {
            return false;
        }
        $textRedo = array_pop($this->textRedo);
        array_push($this->text, $this->textEditor->getText());
        $this->textEditor->setText($textRedo);
    }
}

class PasteCommand implements Command
{
    private $textEditor;
    private $text = array();     // 原始數據備份陣列
    private $textRedo = array(); // 輸入數據備份陣列
    
    public function __construct(TextEditor $textEditor) {
        $this->textEditor = $textEditor;
    }
    
    public function execute($text) {

        // 備份舊資料
        array_push($this->text, $this->textEditor->getText());
        
        // 貼上資料
        $this->textEditor->paste($text);
    }
    
    public function undo(){
        if (count($this->text) <= 0) {
            return;
        }
        $text = array_pop($this->text);
        array_push($this->textRedo, $this->textEditor->getText());
        $this->textEditor->setText($text);
    }
    
    public function redo(){
        if (count($this->textRedo) <= 0) {
            return;
        }
        $textRedo = array_pop($this->textRedo);
        array_push($this->text, $this->textEditor->getText());
        $this->textEditor->setText($textRedo);   
    }
}




// Invoker
class ControlManager
{
    private $undoList = array();
    private $redoList = array();
    
    public function __construct() {
        
    }
    
    private function storeCommand(Command $cmd) {
        array_push($this->undoList, $cmd);
    }
    
    public function clearAllCommand() {
        $this->undoList = array();
        $this->redoList = array();
    }
    
    public function undo(){

        if (count($this->undoList) <= 0) {
            return;
        }
       
        $cmd = array_pop($this->undoList);
        $cmd->undo();
        array_push($this->redoList, $cmd);
    }
    
    public function redo(){

        if (count($this->redoList) <= 0) {
            return;
        }
        $cmd = array_pop($this->redoList);
        $cmd->redo();
        array_push($this->undoList, $cmd);
    }
    
    public function execute(Command $cmd, $text) {
        $this->storeCommand($cmd);
        $cmd->execute($text);
    }
}

?>