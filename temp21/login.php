<?php
//设定字符集
header('content-type:text/html;charset=utf-8');
//初始化数据库,引入公共函数
require "public_function.php";
dbInit();
//保存错误信息
$erroe = array();
//有表单提交时
if(!empty($_POST)){
    //接受用户登录表单
    $username = safeHandle(isset($_POST["username"]) ? $_POST["username"] : "");
    $password = safeHandle(isset($_POST["password"]) ? $_POST["password"] : "");
    //载入表单验证函数库
    require 'check_form.lib.php';
    if(($result = checkUsername($username)) !== true) $error[] = $result;
    if(($result = checkPassword($password)) !== true) $error[] = $result;
    //表单验证通过后，进行数据库验证
    if(empty($error)){
        $sql = "select `id`,`password`,`salt` from `user` where `username`= '$username'";
        if($rst = query($sql)){
            $row = fetchRow($sql);
            //数据库密码加密
            $password_db = md5($row['salt'].md5($password));
            //判断密码是否正确
            if($password_db == $row['password']){
                //是否勾选‘记住密码’
                if(isset($_POST['auto_login']) && $_POST['auto_login'] == 'on'){
                    //用户密码保存至cookie并加密密码
                    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
                    $password_cookie = md5($row['password'].md5($ua.$row['salt']));
                    //保存时间:一个月
                    $cookie_expire = time() + 2592000;
                    //保存用户名
                    setcookie('username',$username,$cookie_expire);
                    //保存密码
                    setcookie('password',$password_cookie,$cookie_expire);
                }
                //登陆成功，保存用户会话
                session_start();
                $_SESSION['userinfo'] = array(
                    //用户id存至session
                    'id' => $row['id'],
                    //用户名存至session
                    'username' => $username
                );
                //登陆成功后跳转至会员中心
                header('Location:user.php');
                //终止脚本
                die;
            }
        }
        $error[] = '用户名不存在或密码错误！';
    }  
}
//cookie中存在登陆状态时
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    //取出用户名和密码
    $username = safeHandle($_COOKIE['username']);
    $password = safeHandle($_COOKIE['password']);
    //取出用户信息
    $sql = "select `id`,`password`,`salt` from `user` where `username`= '$username'";
        if($rst = query($sql)){
            $row = fetchRow($sql);
            //计算密码
            $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $password_cookie = md5($row['password'].md5($ua.$row['salt']));
            //对比cookie密码
            if($password == $password_cookie){
                //登陆成功保存用户会话
                session_start();
                $_SESSION['userinfo'] = array(
                    //用户id存至session
                    'id' => $row['id'],
                    //用户名存至session
                    'username' => $username
                );
                //登陆成功后跳转至会员中心
                header('Location:user.php');
                //终止脚本
                die;
            }
        }
        $error[] = '登陆状态已失效，请重新登录！';      
}
define('APP','login');
require 'login_html.php';






















?>