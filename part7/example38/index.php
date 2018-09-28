<?php
//初始化数据库操作类
require('init.php');
//载入分页类，自动生成分页的HTML链接
require('lib/page.class.php');
//获取当前页码号
$page=isset($_GET['page'])?intval($_GET['page']):1;
//拼接查询条件
//获取要查询的分类ID,0表示全部
$cid=isset($_GET['cid'])?intval($_GET['cid']):0;
//获取查询列表条件
$where='';
if($cid) $where="where `cid`=$cid";
//获取总记录数
$sql="select count(*) as total from `cms_article` $where";
$results=$db->fetchRow($sql);
$total=$results['total'];
//实例化分页类
$Page=new Page($total,2,$page);
$limit=$Page->getLimit();
$page_html=$Page->showPage();
////分页获取文章列表
$sql="select id,title,content,author,addtime,cid from cms_article $where order by `addtime` desc limit $limit";
$articles=$db->fetchAll($sql);
//通过mbstring扩展截取文章内容作为摘要
foreach($articles as $k=>$v){
	//mb_str(内容，开始位置，截取长度，字符集)
	$articles[$k]['content']=mb_substr(trim(strip_tags($v['content'])),0,150,'utf-8').'......';
}
$sql = 'select `id`,`name`,`sort` from `cms_category` order by `sort`';
$category = $db->fetchAll($sql);
require('./view/index.php');