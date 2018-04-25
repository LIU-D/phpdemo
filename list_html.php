<?php if(!defined('APP')) die('error!');?>
<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <title>员工信息列表</title>
  <style>
	.box{margin:20px;}
	.box .title{font-size:22px;font-weight:bold;text-align:center;}
	.box table{width:100%;margin-top:15px;border-collapse:collapse;font-size:12px;border:1px solid #B5D6E6;min-width:460px;}
	.box table th,.box table td{height:20px;border:1px solid #B5D6E6;}
	.box table th{background-color:#E8F6FC;font-weight:normal;}
	.box table td{text-align:center;}
  </style>
	<script>
	function showinfo(str)
	{
		if (str.length==0)
		{ 
			document.getElementById("txtHint").innerHTML="";
			return;
		}
		if (window.XMLHttpRequest)
		{
			// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
			xmlhttp=new XMLHttpRequest();
		}
		else
		{    
			//IE6, IE5 浏览器执行的代码
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","ajax.php?select_info="+str,true);
		xmlhttp.send();
	}
	</script>
</head>
<body>
	<div class="box">
		<div class="title">员工信息列表</div>
		<form action='showList.php' method='post'>
			<input type="text" name="keyword" onkeyup="showinfo(this.value)" />
			<input type="submit" value="input" />
		</form>
		<table border="1">
			<tr>
				<th width="5%">ID<	/th>
				<th>姓名</th>
				<th><a href="showList.php?order=e_dept&sort=<?php echo $sort=="desc"?"asc":"desc";?>">所属部门</a></th>
				<th>出生日期</th>
				<th><a href="showList.php?order=date_of_entry&sort=<?php echo $sort=="desc"?"asc":"desc";?>">入职时间</a></th>
				<th width="25%">相关操作</th>
			</tr>	
				<?php if(!empty($emp_info)) { ?>
				<?php foreach($emp_info as $value) { ?>
				<tr>
				<td><?php echo $value['e_id'];?></td>
				<td><?php echo $value['e_name'];?></td>
				<td><?php echo $value['e_dept'];?></td>
				<td><?php echo $value['date_of_birth'];?></td>
				<td><?php echo $value['date_of_entry'];?></td>
				<td><img src="images/del.gif">增加 <img src="images/edt.gif">删除</td>
			</tr>
			<?php	} ?>
			<?php } else{ ?>
			<tr><td colspan="6">暂无员工数据！</td></tr>
			<?php } ?>
		</table>
	</div>

	<div>
		<?php echo $page_html; ?>
	</div>

	<div id="txtHint">
	</div>
</body>
</html>