<?php
header('content-type:text/html;charset=utf-8');
$info = array(
    "id" => 123,
    "name" => "拉布拉多"
);
if(!empty($_FILES['pic'])){
    $pic_info = $_FILES['pic'];
    //var_dump($pic_info);
//var_dump($_FILES);
    if($pic_info['error'] > 0){
        $error_msg = '上传错误：';
        switch($pic_info['error']){
            case 1: $error_msg .= '文件大小超过了php.ini中upload_max_filesize选项限制的值！';break;
            case 2: $error_msg .= '文件大小超过了表单中max_file_size选项指定的值！';break;
            case 3: $error_msg .= '文件只有部分被上传！';break;
            case 4: $error_msg .= '没有文件被上传！';break;
            case 5: $error_msg .= '找不到临时文件夹！';break;
            case 6: $error_msg .= '文件写入失败！';break;
            default: $error_msg .= '未知错误！';break;
        }
        echo $error_msg;
        return false;
    }
    $type = substr(strrchr($pic_info['name'],'.'),1);
    if($type !== 'jpg'){
        echo '图像不符合要求，允许的类型为:jpg';
        return false;
    }
    $new_file = $info['id'].'.jpg';
    $filename = './img/'.$new_file;
    if(!move_uploaded_file($pic_info['tmp_name'],$filename)){
        echo '头像上传失败！';
        return false;
    }
}
require 'portrait_html.php';
?>