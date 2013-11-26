<?php

    include_once '../../class/pattern/adapter.php';

    $ps2Mouse = new SimplePs2Mouse();   // 建立一個ps/2介面的滑鼠
    
    $ps2UsbAdapter = new Ps2UsbAdapter($ps2Mouse); // 將ps/2介面滑鼠接到轉接器中

    // 現在ps2滑鼠可用usb介面操作
    $ps2UsbAdapter->usb_connect();
    $ps2UsbAdapter->usb_click();
    $ps2UsbAdapter->usb_move();

?>