<?php
    include_once '../../class/pattern/templateMethod.php';


    $wordTextReader = new WordTextReader(); //建立word文字閱讀器
    $adobeTextReader = new AdobeTextReader(); //建立adobe文字閱讀器

    $wordTextReader->readFileProcess();

    echo "<br>";

    $adobeTextReader->readFileProcess();

?>