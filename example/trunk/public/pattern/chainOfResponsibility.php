<?php
    include_once '../../class/pattern/chainOfResponsibility.php';

    
    $data = "balabalcacheabanlabala hahalalalalala";
    $dbLogger = new dbLogger(); 
    $sessionLogger = new sessionLogger();
    $cacheLogger = new cacheLogger();
    
    $sessionLogger->setSuccessor($cacheLogger);
    $dbLogger->setSuccessor($sessionLogger);
    
    $msg = $dbLogger->handleRequest($data); // 順序為 dbLogger -> sessionLogger -> cacheLogger 
    
    echo $msg; // cache log寫入
    exit;
    

    
    
    $chineseDirtyWordHandler = new ChineseDirtyWordFilter(); // 中文髒話過濾
    $englishDirtyWordHandler = new EnglishDirtyWordFilter(); // 英文髒話過濾
    
    $msg = "你這個人真三八，是一個idiot，講的話都是bullshit，真像一個笨蛋加白癡，王八蛋!!";
    
    //$msg = $chineseDirtyWordHandler->handleRequest($msg);
    //echo $msg; // 你這個人真***，是一個idiot，講的話都是bullshit，真像一個***加***，***!!
    
    //$msg = $englishDirtyWordHandler->handleRequest($msg);
    //echo $msg; // 你這個人真三八，是一個???，講的話都是bull???，真像一個笨蛋加白癡，王八蛋!!
    
    $chineseDirtyWordHandler->setSuccessor($englishDirtyWordHandler); // 設定承接response的下家

    $msg = $chineseDirtyWordHandler->handleRequest($msg); 
    echo $msg; // 你這個人真***，是一個???，講的話都是???，真像一個***加***，***!!  
?>