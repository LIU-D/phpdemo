<?php 
//载入init.php文件
require './init.php';
//调用model函数，传入要操作的数据表名以获取对应模型类对象
$student = model('student');
//以下演示两种创建数据的方式
$student->name = 'AN';     //通过对象属性保存学生数据
$studentData = array(
'gender'=>'女',
'birthday'=>'1990-08-21'
);
if($studentId=$student->add($studentData)){
    $studentInfo=$student->getById($studentId);
    echo '<pre>';
        var_dump($studentInfo);
}
?>