<?php
/*
 * 今天我們有一個ps/2介面的滑鼠，要插在用usb介面的電腦上
 */


// USB滑鼠介面
interface UsbMouse
{
    public function usb_click();
    public function usb_move();
    public function usb_connect();
}

// 簡單USB滑鼠
class SimpleUsbMouse implements UsbMouse
{
    public function usb_click() {
        echo "USB滑鼠點一下<br/>";
    }
    
    public function usb_move() {
        echo "USB滑鼠移動<br/>";
    }
    
    public function usb_connect() {
        echo "USB滑鼠連接<br/>";
    }
}

// PS/2滑鼠介面
interface Ps2Mouse
{
    public function ps2_click();
    public function ps2_move();
    public function ps2_connect();
}

// 簡單PS/2滑鼠
class SimplePs2Mouse implements Ps2Mouse
{
    public function ps2_click() {
        echo "PS/2滑鼠點一下<br/>";
    }
    
    public function ps2_move() {
        echo "PS/2滑鼠移動<br/>";
    }
    
    public function ps2_connect() {
        echo "PS/2滑鼠連接<br/>";
    }
}

// PS/2 -> USB轉接器
class Ps2UsbAdapter implements UsbMouse
{
    private $ps2Mouse;
    
    public function __construct(Ps2Mouse $ps2Mouse) {
        $this->ps2Mouse = $ps2Mouse;
    }
    
    public function usb_click() {
        $this->ps2Mouse->ps2_click();
    }
    
    public function usb_move() {
        $this->ps2Mouse->ps2_move();
    }
    
    public function usb_connect() {
        $this->ps2Mouse->ps2_connect();
    }
}



?>