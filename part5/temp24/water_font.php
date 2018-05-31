<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <title>图片添加水印</title>
  <style>
	body{ background:#F1F1F1; font-family:"华文中宋";}
	img{ width:500px;padding:0px; border:1px solid #999; padding:2px;}
	table{ border-collapse:separate; border:1px solid #f0f0f0; width:350px; text-align:center; margin:0 auto; background:#fff;}
  </style>
 </head>
 <body>
<?php
/**
 * 添加水印功能
 * @param string $source 原图
 * @param int $postion 添加水印位置，默认9，右下角
 * @param string $path 水印图片存放路径,默认为空，表示在当前目录
 */
function watermark($source,$path = ''){
	//设置水印图片名称前缀
	$waterPrefix='font_';
	//图片类型和对应创建画布资源的函数名
	$from=array(
		'image/gif'=>'imagecreatefromgif',
		'image/png'=>'imagecreatefrompng',
		'image/jpeg'=>'imagecreatefromjpeg'
	);
	//图片类型和对应生成图片的函数名
	$to=array(
		'image/gif'=>'imagegif',
		'image/png'=>'imagepng',
		'image/jpeg'=>'imagejpeg'
	);
	//获取原图信息
	$src_info=getimagesize($source);

	//从数组中获取原图的宽和高
	list($src_w,$src_h,$src_mime)=$src_info;

	//获取各图片对应的创建画布函数名
	$src_create_fname=$from[$src_info['mime']];

	//使用可变函数来创建画布资源
    $src_img=$src_create_fname($source);
    //设置字体样式
    $font_style = 'C:\Windows\Fonts\FRSCRIPT.TTF';
    $color = imagecolorallocate($src_img,0,0,205);

	/**
	  * 生成水印方式一：将水印图片添加到目标图标上
	  * @param resource $src_img 原图像资源
	  * @param resource $wat_img 水印图像资源
	  * @param int $src_x  水印图片在原图像中的横坐标
	  * @param int $src_y  水印图片在原图像中的纵坐标
	  * @param int 0, 0   水印图片的横坐标和纵坐标
	  * @param int $wat_w 水印图片的宽
	  * @param int $wat_h 水印图片的高
      */
    imagefttext($src_img,50,0,0,50,$color,$font_style,'Concordia');
	//imagecopy($src_img,$wat_img,$src_x,$src_y,0,0,$wat_w,$wat_h);
	//生成水印方式二：使用imagecopymerge()函数设置半透明水印
	//imagecopymerge($src_img,$wat_img,$src_x,$src_y,0,0,$wat_w,$wat_h,50);
	
	//生成带水印的图片路径
	$waterfile=$path.$waterPrefix.$source;
	//获取输出图片格式的函数名
	$generate_fname=$to[$src_info['mime']];
	//判断将添加水印后的图片输出到指定目录是否正确
	if ($generate_fname($src_img,$waterfile)){
		
		//有条理的输出源图像与添加水印后的图像
		echo "<table cellspacing='10'><tr><th colspan='2'>为图片添加水印</th></tr>";
		echo "<tr><td>原图像</td><td><img src='".$source."' /></td></tr>";
		echo "<tr><td>加水印后</td><td><img src='".$waterfile."' /></td></tr></table>";
	}else{
		echo "输出水印图片到指定目录出错！";
		return false;
	}
}
//定义原图片与水印图片路径
$source='class.jpg';
watermark($source);
?>
 </body>
</html>