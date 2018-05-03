<?php
header('content-type:text/html;charset=utf-8');
require "public_function.php";
//连接服务器选择数据库
dbInit();
//提取前台数据
//$_POST['e_name']
//SQL语句并执行
$fields = array('e_name','e_dept','date_of_birth','date_of_entry');
$values = array();
foreach($fields as $key => $val){
    $data = isset($_POST["$val"]) ? $_POST["$val"] : "";
    if($data == '') die($val.'字段不能为空！');
    $data = safeHandle($data);
    $values[] = "'$data'";
    $fields[$key] = "`$val`";
}
//数组转字符串
$fields = implode(',' , $fields);
$values = implode(',' , $values);
//`e_name`, `e_dept`, `date_of_birth`, `date_of_entry`
$sql = "INSERT INTO `php`.`emp_info` ($fields) VALUES ($values)";.

//跳转到视图页面
if($res = query($sql)){
    header('Location:showList.php');
    die;
}else{
    die('添加员工失败！');
};

?>