<?php

    include_once '../../class/pattern/proxy.php';
    
    $permissionProxy = new PermissionProxy();

    $permissionProxy->modifyUserInfo();
    $permissionProxy->viewNote();
    $permissionProxy->publishNote();
    $permissionProxy->modifyNote();

    echo "<br>";
    $permissionProxy->setLevel(1);
    $permissionProxy->modifyUserInfo();
    $permissionProxy->viewNote();
    $permissionProxy->publishNote();
    $permissionProxy->modifyNote();
?>