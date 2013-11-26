<?php

    include_once '../../class/pattern/bridge.php';
    

    $androidPlatform = new AndroidPlatform();
    $iosPlatform = new IOSPlatform();

    $angryBirdNormalAndroid = new AngryBirdNormal($androidPlatform);
    $angryBirdNormalAndroid->play();


    $angryBirdSpaceIOS = new AngryBirdSpace($iosPlatform);
    $angryBirdSpaceIOS->play();

?>


<?php 

    /*
    $androidAngryBirdNormal = new AndroidAngryBirdNormal();
    echo $androidAngryBirdNormal->play();
    
    echo '<br/>';
    
    $iosAngryBirdSpace = new iosAngryBirdSpace();
    echo $iosAngryBirdSpace->play();
    */

?>