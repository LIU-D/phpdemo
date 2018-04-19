<?php
/**
  * 分页链接生成函数
  * @param int $page URL传递的page值
  * @param int $max_page 最大页码值
  */
function makePageHtml($page,$max_page){

	 //设置变量，保留GET参数
	$prams = ''; 
	//删除GET参数中的page
	unset($_GET['page']);  
	//循环遍历$_GET数组，重新拼接URL中的GET参数
	foreach($_GET as $k=>$v){
		$prams .= "$k=$v&";
	}
	//计算下一页
	$next_page = $page +1;
	//判断下一页的页码是否大于最大页码值，如果大于则把最大页码值赋值给它
    if($next_page > $max_page)  $next_page =  $max_page;
	//计算上一页
    $prev_page = $page - 1;
	//判断上一页的页码是否小于1，如果小于则把1赋值给它
	if($prev_page < 1 ) $prev_page  = 1;
	//重新拼接分页链接的html代码
	$page_html = '<a href="?'.$prams.'page=1">首页</a>&nbsp;';
	$page_html .= '<a href="?'.$prams.'page='.$prev_page.'">上一页</a>&nbsp;';
	$page_html .= '<a href="?'.$prams.'page='.$next_page.'">下一页</a>&nbsp;';
	$page_html .= '<a href="?'.$prams.'page='.$max_page.'">尾页</a>&nbsp;';
	//返回分页链接
	return $page_html;
}
//调用函数生成分页链接
//$page_html = makePageHtml($page,$max_page);