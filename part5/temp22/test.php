<?php
header('content-type:text/html;charset=utf-8');
$info = array(
    "id" => 123,
    "name" => "拉布拉多"
);
$info_file = isset($_FILES['pic']) ? $_FILES['pic'] : "";
if(!empty($info_file)){
    move_uploaded_file($info_file['tmp_name'],"./img/default.jpg");
}
require 'portrait_html.php';

?>