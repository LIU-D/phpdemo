<?php
header('content-type:text/html;charset=utf-8');
//数据库服务器类型MYSQL
$dbms='mysql';
//数据库服务器主机名、端口号、选择的数据库
$host='localhost';
$port='3306';
$dbname='php';
//设定字符集
$charset='utf8';
//用户名和密码
$user='root';
$pwd='741258o';
$dsn="$dbms:host=$host;port=$port;dbname=$dbname;charset=$charset";
//PDO连接数据库
try{
	//连接数据库、选择数据库、设定字符集
  $pdo=new PDO($dsn,$user,$pwd);

}catch(PODException $e){
	//输出异常信息
     echo  $e->getMessage().'<br>';
}
//执行sql语句
$sql='select * from `books`';
$result=$pdo->query($sql);
//定义数组用于保存书籍信息
$book_info=array();
//遍历结果集，获取书籍的详情信息
while($row=$result->fetch()){
	$book_info[]=$row;
}
//加载HTML模板
define('APP','test1');
require('book_html.php');
?>
