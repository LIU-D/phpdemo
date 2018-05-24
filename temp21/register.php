<?php
//设定字符集
header('content-type:text/html;charset=utf-8');
//保存错误信息
$error = array();
//查看提交的表单
//var_dump($_POST);
//封装函数：载入HTML模板文件
function showRegPage(){
    //从全局变量读取错误信息
    $error = $GLOBALS['error'];
    define('APP','register');
    require 'register_html.php';
    die;
}
//无表单提交时显示注册页面
if(empty($_POST)){
    showRegPage();
}

//初始化数据库,引入公共函数
require "public_function.php";
//引入表单验证函数库
require "check_form.lib.php";
dbInit();
//接收表单数据，同时过滤数据，防止SQL注入
$username = safeHandle(isset($_POST["username"]) ? $_POST["username"] : "");
$email = safeHandle(isset($_POST["email"]) ? $_POST["email"] : "");
$password = safeHandle(isset($_POST["password"]) ? $_POST["password"] : "");

$data = array(
	'username' => "'$username'",
	'password' => "'$password'",
	'email' => "'$email'",
);

//为每个字段定义不同的验证函数
$validate = array(
    'username' => 'checkUsername',
	'password' => 'checkPassword',
	'email' => 'checkEmail',
);
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

//判断用户名是否重名
$sql_name = "SELECT `id` FROM `user` WHERE `username` = '$username'";
if(fetchRow($sql_name)){
    $error[] = '用户名已存在！请更改。';
    showRegPage();
}
//生成密码盐
$salt = md5(uniqid(microtime()));
//密码安全提升
$password = md5($salt.md5($password));

//拼接insert的SQL语句
$sql = "INSERT INTO `php`.`user` (`username`,`password`,`salt`,`email`)
        VALUES ('$username','$password','$salt','$email')";  
$sql_info = "INSERT INTO `php`.`userinfo` (`nickname`,`email`)
        VALUES ('$username','$email')";
    
//执行
//跳转到视图页面
if($res = query($sql)){
    query($sql_info);

    //用户注册成功自动登录
    session_start();
    //获取ID
    $id= mysql_insert_id();
    $_SESSION['userinfo'] = array(
        'id' => $id,
        'username' => $username
    );
    echo '<script>alert("注册成功！");window.location.href="user.php";</script>';
    die;
}else{
    $error[] = '注册失败。';
    showRegPage();
}  
// }else{
//     define('APP','php');
//     require 'register_error_html.php';
// }

define('APP','php');


?>