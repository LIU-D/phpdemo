
 <?php 
    date_default_timezone_set ( 'PRC' );
    //声明HTML消息头的文档编码格式
    header('content-type:text/html;charset=utf-8');
    // 连接数据库服务器
    $link = mysql_connect('localhost','root','741258o');
    if(!$link){
        die('连接数据库失败！'.mysql_error());
    }
    // 设置数据库编码方式
    mysql_query('set names utf8');
    // 选择数据库
    mysql_select_db("php", $link);

    $fields = array('e_dept','date_of_entry');
    //初始化排序语句
    $sql_order = '';
    //判断
    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $select_info = isset($_GET['select_info']) ? $_GET['select_info'] : '';

    if(in_array($order,$fields)) {
        if($sort == 'desc'){
            $sql_order = 'order by $order desc';
            $sort = 'asc';
        }else{
            $sql_order = 'order by $order asc';
            $sort = 'desc';
        }
    }

    //信息搜索
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : ' ';
    //echo $keyword;    

    //输入数据进行sql转义
    $keyword = mysql_real_escape_string($keyword);

    //where 子句  like %任意数量字符
    $where = "where e_name like '%$keyword%'";

    //每页条数
    $page_size = 3;
    //页

    $page = isset($_GET['page']) ? $_GET['page'] : 3;
    //最大页码数
    $res_count = mysql_query("select count(*) from `emp_info`");
    $count = mysql_fetch_row($res_count);
    $page_max = ceil($count[0] / $page_size);
    
    $next_page = $page + 1;
    $last_page = $page - 1 ;
    // $page_html = '  <a href="showList.php?page=1">首页</a>
    //                 <a href="showList.php?page=' .($last_page < 1 ? 1 : $last_page) . '">上一页</a>
    //                 <a href="showList.php?page=' .($next_page > $page_max ? $page_max: $next_page) . '">下一页</a>
    //                 <a href="showList.php?page=' . $page_max . '">尾页</a>       ';

    $limit = ($page - 1) * $page_size;
    require "page_function.php";
    $sql_limit = "select * from `emp_info` limit $limit,$page_size ";
    $page_html = makePageHtml($page,$page_max);


    // 数据库操作
    $sql = "select * from `emp_info` $where $sql_order";
    //结果集
    $result=mysql_query($sql_limit,$link);
    //员工数组
    $emp_info = array();
    //$emp_info = array();
    while($row = mysql_fetch_assoc($result)){
        $emp_info[]=$row;
    }
    //释放资源
    //mysql_free_result();
    //关闭数据库
    //mysql_close($link);
    define("APP","php");
    require "list_html.php";
?>

