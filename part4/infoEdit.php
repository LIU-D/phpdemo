<?php
//案例17：用户信息编辑
//1、初始化操作    
//设定字符集
header('content-type:text/html;charset=utf-8');
//连接数据库,选择数据库
dbInit();

//2、预设准备
//下拉列表数组预设：定义数组$city保存预设的城市下拉列表
$city = 
//复选框数组预设：定义数组$skill保存预设的语言技能复选框

//假设当前登录的用户的ID为1
$id = 1;

//3、首次进入
//执行到此处表示没有表单提交，程序将根据id查询用户信息并显示到表单里
if(empty($_POST)){
    $sql = "SELECT * FROM `userinfo` WHERE `id`=$id";
    if(query($sql)){
        header('Location:profile_html.php');
    }
}
   //根据指定id查询用户信息
   //$data保存查询到的用户信息
   //判断是否查询到数据
   //将skill字段通过“,”分隔符转换为数组
   //加载HTML模板文件

//4、表单提交
//判断是否有表单提交//当有表单提交时，收集表单数据，保存到数据库中
	//指定需要接收的表单字段$fields
       //根据程序中定义好的表单字段收集$_POST数据
      
     //单选框处理
     //下拉菜单处理
     //复选框处理
     //通过循环数组，自动拼接SQL语句，保存到数据库中
    //输出执行结果和调试信息
    ?>