<?php
header('content-type:text/html;charset=utf-8');
//准备测试数据
$all_data = array(
    //文章id => array(文章标题，文章内容)
    1 => array('马克龙同内塔尼亚胡通话 呼吁以色列与巴勒斯坦和谈','………………'),
    2 => array('美中央情报局泄密案已查明 嫌犯系其软件工程师','………………'),
    3 => array('阿根廷联邦法官下令逮捕前总统克里斯蒂娜','………………'),
    4 => array('印刷日期有误 美国公民与移民局召回8543份绿卡','………………'),
);
//获取当前文章id
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
//计算上一篇文章的id
$id_prev = $id - 1;
//计算下一篇文章的id
$id_next = $id + 1;
//防止越界（最低为1，最高为4）
if($id < 1) $id = 1;
if($id > 4) $id = 4;
if($id_prev < 1) $id_prev = 1;
if($id_next > 4) $id_next = 4;
//判断COOKIE中是否存在history记录
if(isset($_COOKIE['history'])){
	//history存在时，取出数据
    //获取COOKIE，保存到数组中，限制数组最多只能有4个元素
    $cookie_arr = explode(',',$_COOKIE['history'],4);
    //遍历数组
    foreach($cookie_arr as $k => $v){
        //将数组中的每个元素转换为整型
        $cookie_arr[$k] = intval($cookie_arr[$k]);
		//如果当前文章id在数组中已经存在，则删除
        if($v == $id) unset($cookie_arr[$k]);
    }
	//当数组元素达到4个时，删除第1个元素
    if(count($cookie_arr) > 3){
        array_shift($cookie_arr);
    }
    //将当前访问的文章id添加到数组末尾
    $cookie_arr[] = $id;
    //将数组转换为字符串，重新保存到COOKIE中
    setcookie('history',implode(',',$cookie_arr));
}else{
	//history不存在时，向COOKIE中保存history记录
    //通过数组保存浏览历史id
    $cookie_arr = array($id);
    //将当前文章id保存到COOKIE中
    setcookie('history',$id);
}
//清除历史功能
// if(isset($_GET['action'])){
//     if($_GET['action'] == 'clear'){
//         //清除历史记录数组
//         $cookie_arr = array(); 
//     }
// }
//清除历史功能
if(isset($_GET['action'])){
    if($_GET['action'] == 'clear'){
        //清除历史记录数组
        $cookie_arr = array(); 
        //清楚cookie
        setcookie('history', '', time()-1);
    }
}
//$data保存当前页对应的文章数据
$data = $all_data[$id];
//$data_history保存COOKIE中的历史记录
$data_history = array();
foreach($cookie_arr as $v){
    if(isset($all_data[$v])){
        //$data_history[文章id] = 文章标题
        $data_history[$v] = $all_data[$v][0];
    }
}
//加载HTML模板文件
define('APP','article');
require 'article_html.php';























?>