<?php
    include_once '../../class/pattern/commandUndo.php';
    
    $dummyWord = new DommyWord("今天天氣真好");
    $dummyWordPaste = new PasteCommand($dummyWord);
    $dummyWordCut = new CutCommand($dummyWord);
    
    $controlManager = new ControlManager();

     
    $controlManager->execute($dummyWordPaste, ",哇哈哈"); // 今天天氣真好,哇哈哈
    $controlManager->execute($dummyWordPaste, ",你好嗎"); // 今天天氣真好,哇哈哈,你好嗎

    $controlManager->undo();    // 今天天氣真好，哇哈哈
    $controlManager->undo();    // 今天天氣真好
    $controlManager->redo();    // 今天天氣真好，哇哈哈
    $controlManager->redo();    // 今天天氣真好,哇哈哈,你好嗎
    
    echo "<br/>";
    
    $controlManager->execute($dummyWordCut, "今天");  // 天氣真好,哇哈哈,你好嗎  
    
    // 三次undo
    $controlManager->undo();  // 今天天氣真好,哇哈哈,你好嗎
    $controlManager->undo();  // 今天天氣真好，哇哈哈
    $controlManager->undo();  // 今天天氣真好

    
    // 到第四次undo已經沒有資料了，所以沒有任何字串出現
    $controlManager->undo();


    // 三次redo
    $controlManager->redo();  // 今天天氣真好，哇哈哈
    $controlManager->redo();  // 今天天氣真好,哇哈哈,你好嗎
    $controlManager->redo();  // 天氣真好,哇哈哈,你好嗎

?>