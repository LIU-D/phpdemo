<?php if(!defined('APP')) die('error!'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户信息编辑</title>
<style>
body{background-color:#eee;margin:0;padding:0;}
.box{width:400px;margin:15px;padding:20px;border:1px solid #ccc;background-color:#fff;}
.box h1{font-size:20px;text-align:center;}
.profile-table{margin:0 auto;}
.profile-table th{font-weight:normal;text-align:right;}
.profile-table input[type="text"]{width:180px;border:1px solid #ccc;height:22px;padding-left:4px;}
.profile-table .button{background-color:#0099ff;border:1px solid #0099ff;color:#fff;width:80px;height:25px;margin:0 5px;cursor:pointer;}
.profile-table .td-btn{text-align:center;padding-top:10px;}
.profile-table th,.profile-table td{padding-bottom:10px;}
.profile-table td{font-size:14px;}
.profile-table .desc{width:250px;height:60px;border:1px solid #ccc;}
.profile-table .txttop{vertical-align:top;}
.profile-table select{border:1px solid #ccc;min-width:80px;height:25px;}
.profile-table .description{font-size:13px;width:250px;height:60px;border:1px solid #ccc;}
</style>
</head>
<body>
<div class="box">
	<h1>编辑个人资料</h1>
	<form method="post">
	<table class="profile-table">
		<tr><th>用户名：</th><td><input disabled="true " type="text" name="nickname" value="<?php echo $data['nickname']; ?>" /></td></tr>
		<tr><th>性别：</th><td>
			<input type="radio" name="gender" value="男" id="male" <?php if($data['gender']=='男') echo 'checked'; ?> /><label for="male">男</label>
			<input type="radio" name="gender" value="女" id="female" <?php if($data['gender']=='女') echo 'checked'; ?> /><label for="female">女</label>
		</td></tr>
		<tr><th>邮箱：</th><td><input type="text" name="email" value="<?php echo $data['email']; ?>" /></td></tr>
		<tr><th>QQ号：</th><td><input type="text" name="qq" value="<?php echo $data['qq']; ?>" /></td></tr>
		<tr><th>个人主页：</th><td><input type="text" name="url" value="<?php echo $data['url']; ?>" /></td></tr>
		<tr><th>所在城市：</th><td>
			<select name="city">
				<option value="未选择">未选择</option>
				<?php foreach($city as $v): ?>
					<option value="<?php echo $v ?>" <?php if($data['city']==$v) echo 'selected'; ?> ><?php echo $v ?></option>
				<?php endForeach; ?>
			</select>
		</td></tr>
		<tr><th>语言技能：</th><td>
			<?php foreach($skill as $k=>$v): ?>
				<input type="checkbox" name="skill[]" id="ck<?php echo $k; ?>" value="<?php echo $v; ?>" <?php if(in_array($v,$data['skill'])) echo 'checked'; ?> /><label for="ck<?php echo $k; ?>"><?php echo $v; ?></label>
			<?php endForeach; ?>
		</td></tr>
		<tr><th class="txttop">自我介绍：</th><td><textarea class="description" name="description"><?php echo $data['description']; ?></textarea></td></tr>
		<tr><td colspan="2" class="td-btn">
		<input type="submit" value="保存资料" class="button" />
		<input type="reset" value="重新填写" class="button" />
		<input type="button" onclick="javascrtpt:window.location.href='./user.php'" value="返回主页" class="button" />
		</td></tr>
	</table>
	</form>
</div>
</body>
</html>