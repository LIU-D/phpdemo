<?php
//设定字符集
header('content-type:text/html;charset=utf-8');

//查看提交的表单
//var_dump($_POST);
//获取注册用户的信息

//初始化数据库,引入公共函数
require "public_function.php";

//引入表单验证函数库
require "check_form.lib.php";

dbInit();

//当没有表单提交时退出程序
if(empty($_POST)) die("没有表单提交！");


/***********************************************************************************************************************/
// $data = array(
// 	'username' => '小明',
// 	'password' => '123456',
// 	'email' => 'xiaoming@123.com',
// );
/***********************************************************************************************************************/


//接收表单数据，同时过滤数据，防止SQL注入
$username = safeHandle(isset($_POST["username"]) ? $_POST["username"] : "");
$email = safeHandle(isset($_POST["email"]) ? $_POST["email"] : "");
$password = safeHandle(isset($_POST["password"]) ? $_POST["password"] : "");

$data = array(
	'username' => "'$username'",
	'password' => "'$password'",
	'email' => "'$email'",
);


//判断用户名是否重名
$sql_name = "SELECT `id` FROM `user` WHERE `username` = '$username'";
if(fetchRow($sql_name)){
    die('用户名已存在！请更改。');
}
//密码加密
$password = md5($password);
/***********************************************************************************************************************/

//为每个字段定义不同的验证函数
$validate = array(
    'username' => 'checkUsername',
	'password' => 'checkPassword',
	'email' => 'checkEmail',
);
//$error数组保存验证失败时的错误信息
$error = array();
$check_fileds = array('username','password','email');
//循环验证每个字段，保存错误信息
foreach($check_fileds as $k => $v){
    if(empty($_POST[$v])){
        die($v."字段不能为空");
    }else{
        $data[$v] = $_POST[$v];
    }
}
foreach($validate as $k => $v){
    //运用可变函数，实现不同字段调用不同函数
    $res = $v($data[$k]);
    if($res !== true){
        $error[] = $res;
    }
}



//判断表中的字段是否都已经填写
// $check_fields = array('username','password','email');
// foreach($check_fields as $key => $val){
//     $data = isset($_POST["$val"]) ? $_POST["$val"] : "";
//     if($data == '') die($val.'不能为空！');
// }

//拼接insert的SQL语句
if(empty($error)){
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
}else{
    define('APP','php');
    require 'register_error_html.php';
}




?>