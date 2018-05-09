<?php
//设定字符集
header('content-type:text/html;charset=utf-8');

//查看提交的表单
//var_dump($_POST);
//获取注册用户的信息

//初始化数据库,引入公共函数
require "public_function.php";
dbInit();

//当没有表单提交时退出程序
if(empty($_POST)) die("没有表单提交！");

//判断表中的字段是否都已经填写
$check_fields = array('username','password','email');
foreach($check_fields as $key => $val){
    $data = isset($_POST["$val"]) ? $_POST["$val"] : "";
    if($data == '') die($val.'不能为空！');
}
//接收表单数据，同时过滤数据，防止SQL注入
$username = safeHandle(isset($_POST["username"]) ? $_POST["username"] : "");
$email = safeHandle(isset($_POST["email"]) ? $_POST["email"] : "");
$password = safeHandle(isset($_POST["password"]) ? $_POST["password"] : "");



//判断用户名是否重名
$sql_name = "SELECT `id` FROM `user` WHERE `username` = '$username'";
if(fetchRow($sql_name)){
    die('用户名已存在！请更改。');
}
//密码加密
$password = md5($password);

//拼接insert的SQL语句
$sql = "INSERT INTO `php`.`user` (`username`,`password`,`email`)
        VALUES ('$username','$password','$email')";

//执行
//跳转到视图页面
if($res = query($sql)){
    echo '注册成功！';
    die;
}else{
    die('注册失败！');
};

?>