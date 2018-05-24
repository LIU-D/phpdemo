<?php
header('content-type:text/html;charset=utf-8');
//启动SESSION
session_start();
//用户退出
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    //清除cookie
    setcookie('username','',time()-1);
    setcookie('password','',time()-1);
    //清除SESSION数据
    unset($_SESSION['userinfo']);
    //如果SESSION中没有其他数据，则销毁SESSION
    if(empty($_SESSION)){
        session_destroy();
    }
    //跳转到登陆页面
    header('Location:login.php');
    //终止脚本
    die;
}
//判断SESSION中是否存在用户信息
if(isset($_SESSION['userinfo'])){
    //用户信息存在，用户已登陆
    $login = true;  //保存用户状态
    $userinfo = $_SESSION['userinfo'];  //获取用户信息
}else{
    //用户信息不存在，用户没有登陆
    $login = false;
}
//加载HTML模板文件
define('APP','user_html');
require 'user_html.php';
?>