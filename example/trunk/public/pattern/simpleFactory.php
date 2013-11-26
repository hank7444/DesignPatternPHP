<?php

    include_once '../../class/pattern/simpleFactory.php';

    $building = new CreateBuildCenter(); 		 // 建立生產中心
    
    $solider = $building->outputUnit('solider'); // 建立士兵
    $worker = $building->outputUnit('worker');	 // 建立工兵

?>