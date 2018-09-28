<?php
header('content-type:text/html;charset=utf-8');
$info = array(
    "id" => 123,
    "name" => "李"
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
    //获取图像信息数组
    $img_info = getimagesize($pic_info['tmp_name']);
    //保存数据
    list($w,$h) = getimagesize($pic_info['tmp_name']);
    //设置缩略图的最大宽高
    $max_width = $max_height = 90;
    //将最大边设置为缩略图的边长
    if($w > $h){
        //缩略图宽为$w
        $new_width = $max_width;
        //计算缩略图高
        $new_height = round($new_width * $h / $w);
    }else{
        //缩略图高为$h
        $new_height = $max_height;
        //计算缩略图宽
        $new_width = round($new_height * $w / $h);
    }
    //创建画布-缩略图
    $thumb = imagecreatetruecolor($new_width,$new_height);
    //原图像资源
    $source = imagecreatefromjpeg($pic_info['tmp_name']);
    //创建缩略图
    imagecopyresized($thumb,$source,0,0,0,0,$new_width,$new_height,$w,$h);
    //缩略图保存路径
    $new_file = './img/'. $info['id'].'.jpg';
    //保存缩略图到指定目录
    imagejpeg($thumb,$new_file,100);
    //header('Content-type:image/jpeg');

    //$new_file = $info['id'].'.jpg';
    // $filename = './img/'.$new_file;
    // if(!move_uploaded_file($pic_info['tmp_name'],$filename)){
    //     echo '头像上传失败！';
    //     return false;
    // }
}
require 'portrait_html.php';
?>