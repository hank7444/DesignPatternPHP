<?php
    include_once '../../class/pattern/mediator.php';

    $data["台北市"][] = "內湖區";
    $data["台北市"][] = "大安區";
    $data["台北市"][] = "中正區";
    $data["台北市"][] = "中山區";
    $data["高雄市"][] = "旗津區";
    $data["高雄市"][] = "那馬夏區";
    $data["高雄市"][] = "小港區";
    
    $copyBtn = new CopyButton();        // 建立Copy按鈕
    $clearBtn = new ClearButton();      // 建立Clear按鈕
    $parentList = new ParentListBox();  // 建立母列表
    $childList = new ChildListBox();    // 建立子列表
    
    // 建立Mediator
    $formMediator = new FormMediator($copyBtn, $clearBtn, $parentList, $childList);
    
    $copyBtn->setMediator($formMediator);  
    $clearBtn->setMediator($formMediator); 
    $parentList->setMediator($formMediator);
    $childList->setMediator($formMediator);
    
    $copyBtn->execute();    // 複製按鈕目前禁用中
    $clearBtn->execute();   // 清除按鈕目前禁用中
    
    $parentList->setData($data);    
    $parentList->select("台北市");  // 母項目選擇了台北市，以下是子項目列表:
                                   // Array ( [0] => 內湖區 [1] => 大安區 [2] => 中正區 [3] => 中山區 ) 
    $copyBtn->execute();           // 複製按鈕按下
    $clearBtn->execute();          // 清除按鈕目前禁用中
    
    $childList->select("內湖區");   // 子項目選擇了內湖區
    $copyBtn->execute();           // 複製按鈕按下
    $clearBtn->execute();          // 清除按鈕按下，已將子列表的內容清除!
    
    $copyBtn->execute();           // 複製按鈕目前禁用中
    $clearBtn->execute();          // 清除按鈕目前禁用中
?>