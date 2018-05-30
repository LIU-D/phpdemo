<?php
header('content-type:text/html;charset=utf-8');
$img = 'img/123.jpg';
print_r(getimagesize($img));
list($w,$h,$t,$va) = getimagesize($img);
echo $w;



?>