<?php
header('content-type:text/html;charset=utf-8');
$select_info = isset($_GET["select_info"]) ? ($_GET["select_info"]) : '';
 
if(empty($select_info)) {
    echo '请选择一个网站';
    exit;
}
 
$con = mysqli_connect('localhost','root','741258o');
if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
// 选择数据库
mysqli_select_db($con,"php");
// 设置编码，防止中文乱码
mysqli_set_charset($con, "utf8");
$where = "where e_name like '%$select_info%'"; 
$sql="SELECT * FROM emp_info $where ";
 
$result = mysqli_query($con,$sql);
 
echo "<table border='1'>
<tr>
<th>ID</th>
<th>NAME</th>
<th>DEPARTMENT</th>
<th>BIRTH</th>
<th>ENTRY</th>
</tr>";
 
while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['e_id'] . "</td>";
    echo "<td>" . $row['e_name'] . "</td>";
    echo "<td>" . $row['e_dept'] . "</td>";
    echo "<td>" . $row['date_of_birth'] . "</td>";
    echo "<td>" . $row['date_of_entry'] . "</td>";
    echo "</tr>";
}
echo "</table>";
 
mysqli_close($con);
require "list_html.php";
?>