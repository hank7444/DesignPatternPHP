<?php
    include_once '../../class/pattern/observer.php';
    
    /*
    $login = new Login();   // 建立登入類別
    $login->attach(new SecurityMonitor()); // 將安全監控類別註冊
    $login->handleLogin("", "hank", "192.168.1.101");
    */
    
    
    $login = new Login();
    new SecurityMonitor($login);
    new GeneralLogger($login);
    new PartnershipTool($login);
    $login->handleLogin("", "hank", "192.168.1.101");

?>
