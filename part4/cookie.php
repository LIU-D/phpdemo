<?php
header('content-type:text/html;charset=utf-8');
//设置cookie
setcookie("city", "Chengde", time()+3600);
//取
echo $_COOKIE['city'];
?>

<script>
document.cookie = "abc";
    alert(document.cookie);
</script>