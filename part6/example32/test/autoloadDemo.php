<?php
header('content-type:text/html;charset=utf-8');

spl_autoload_register('myAutoLoad', true, true);

function myAutoLoad($className){
    echo "所有的包含文件工作都交给我！\r\n";
    $classFileName = "./{$className}.php";
    echo "我来包含！{$classFileName}\r\n";
    include "./{$className}.php";
}


$objDemo = new AutoloadClass();
$objDemo = new AutoloadClassp();

	
?>