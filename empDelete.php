<?php
header('content-type:text/html;charset=utf-8');
require "public_function.php";

//连接服务器选择数据库
dbInit();
//提取ID
$e_id = isset($_GET['e_id']) ? $_GET['e_id'] : "";

//拼接sql
$ql = "DELETE FROM `php`.`emp_info` WHERE `emp_info`.`e_id`= $e_id";   
//执行sql delete相应数据
$res = query($sql);
header('Location:showList.php');

?>