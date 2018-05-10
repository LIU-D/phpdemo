<?php
//初始化操作   
//设定字符集
header('content-type:text/html;charset=utf-8');
//连接数据库,选择数据库
require "public_function.php";
dbInit();
//2、预设准备
//下拉列表数组预设：定义数组$city保存预设的城市下拉列表
$city = array('北京','上海','广州','其他');
//复选框数组预设：定义数组$skill保存预设的语言技能复选框
$skill = array('HTML','JavaScript','PHP','C++');
//假设当前登录的用户的ID为1
$id = 1;
//3、首次进入
//执行到此处表示没有表单提交，程序将根据id查询用户信息并显示到表单里
$sql = "select * from userinfo where id=$id";
//根据指定id查询用户信息
$data = fetchRow($sql);
//$data保存查询到的用户信息

//判断是否查询到数据
if(!$data){
    die("数据读取失败！");
}else{
    //将skill字段通过“,”分隔符转换为数组
    $data['skill'] = explode(',',$data['skill']);
    define("APP","temp17load");
    require 'profile_html.php';
}


//4、表单提交
//判断是否有表单提交//当有表单提交时，收集表单数据，保存到数据库中
if(!empty($_POST)){
    //指定需要接收的表单字段$fields
    $fields = array('nickname','gender','email','qq','url','city','skill','description');
    //根据程序中定义好的表单字段收集$_POST数据
    foreach($fields as $v){
        $save_data[$v] = isset($_POST[$v]) ? $_POST[$v] : "";
    }
    //单选框处理
    if($save_data['gender'] != '男' && $save_data['gender'] != '女'){
        die('保存失败！未选择性别。');
    }
    //下拉菜单处理
    if($save_data['city'] != '未选择' && !in_array($save_data['city'],$city)){
        die('保存失败！城市不在列表中。');
    }
     //复选框处理
     if(is_array($save_data['skill'])){
         $save_data['skill'] = array_intersect($skill,$save_data['skill']);
         $save_data['skill'] = implode(',',$save_data['skill']);
     }else{
         $save_data['skill'] = '';
     }
     //通过循环数组，自动拼接SQL语句，保存到数据库中
     $update = array();
     foreach($save_data as $k =>$v){
         $v = safeHandle($v);
         $update[] = "`$k`='$v'";
     }
     $update_str = implode(',',$update);
     $sql = "update userinfo set $update_str where id=$id";
    //输出执行结果和调试信息
    if(query($sql)){
        echo "保存成功！";
        //header('Location:temp17.php');

    }else{
        echo "保存失败";
    }
}
	
       
      
     
     
     





?>