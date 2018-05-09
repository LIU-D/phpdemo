<?php
header('content-type:text/html;charset=utf-8');
require "public_function.php";

//连接服务器选择数据库
dbInit();
//提取ID
$e_id = isset($_GET['e_id']) ? $_GET['e_id'] : "";

if(!empty($_POST)){//修改完毕，验证表单，进行安全处理，拼接sql语句并执行，跳转到前台页面。
    $fields = array('e_name','e_dept','date_of_birth','date_of_entry');
    $values = array();
    foreach($fields as $key => $val){
        $data = isset($_POST["$val"]) ? $_POST["$val"] : "";
        if($data == '') die($val.'字段不能为空！');
        $data = safeHandle($data);
        $values[] = "`$val` = '$data'";
        $fields[$key] = "`$val`";
    }
    //数组转字符串
    $fields = implode(',' , $fields);
    $values = implode(',' , $values);
    $sql = "UPDATE  `php`.`emp_info` SET  $values WHERE  `emp_info`.`e_id` = $e_id";
    if(query($sql)){
        header('Location:showList.php');
    }
}else{//未进行修改，根据ID查询数据库对应内容，显示到前台页面update_html.php，再进行修改操作。
    
    //执行sql select相应数据
    $sql = "SELECT * FROM `emp_info` WHERE `e_id`=$e_id";
    //结果放入数组emp_info，前台取值
    $emp_info = fetchRow($sql);
    //require前台页面update_html.php
    //defined('APP')) die('error!');
    require "update_html.php";
}

?>