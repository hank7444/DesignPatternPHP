<?php

    include_once '../../class/pattern/flyweight.php';

    $charArr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
                     'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $colorArr = array("black", "red", "orange", "yellow", "pink", "brown", "blue", "green");
    $sizeArr = array(12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22);

    $flyweightFactory = new FlyweightFactory();

    // 取得記憶體使用量
    $MaxMem = memory_get_peak_usage();
    $MEMBefore =memory_get_usage();

    echo "產生物件前記憶體目前用掉{$MEMBefore}  , 最多用掉{$MaxMem} ";

    echo "<br>";

    for ($i = 0; $i < 100000; $i++) {

        $char = $charArr[rand(0, 25)];
        $size = $sizeArr[rand(0, 10)];
        $color = $colorArr[rand(0, 7)];
        $posX = rand(0, 1000);
        $posY = rand(0, 1000);

        $character = new Character($char, $size, $color, $posX, $posY);
        $chars[] = $character;

    }


    // 取得記憶體使用量
    $MaxMem = memory_get_peak_usage();
    $MEM = memory_get_usage() - $MEMBefore;

    echo "產生物件後記憶體目前用掉{$MEM}  , 最多用掉{$MaxMem} ";




/*
    //$character = $flyweightFactory->getFlyweight($char);
        //$character->showChar($size, $color, $posX, $posY);

        $charsExtrinasicStatus[] = array($char, $size, $color, $posX, $posY);
*/

/*
// Displays the amount of memory being used as soon as the script runs
echo memory_get_usage() . "<br/>";   // Returns 46552 Bytes

//Your code goes here
$a = str_repeat('Avinash Pawar', 100000);

// Displays the amount of memory being used by your code
echo memory_get_usage() . "<br/>"; // Returns 176636 Bytes
*/


/*
    // unshared
    $uflyweight = $flyweightFactory->getFlyweight(array('state A', 'state B'));  
    $uflyweight->operation('other state A'); 


    
    $flyweightFactory = new FlyweightFactory();  
    $flyweight = $flyweightFactory->getFlyweight("state A");  
    $flyweight->operation("other state A");  
          
    $flyweight = $flyweightFactory->getFlyweight("state B");  
    $flyweight->operation("other state B");  

    echo "<br/>";


    // unshared
    $uflyweight = $flyweightFactory->getFlyweight(array('state A', 'state B'));  
    $uflyweight->operation('other state A');  
*/
?>
