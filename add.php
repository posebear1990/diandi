<!Doctype html>
<html>
<head>
	<title>点滴：连接一生点滴</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	$cookie_condition = ($_COOKIE['username'] && $_COOKIE['confirm']);
	if($cookie_condition){
		include("connect.php");//引入连接数据库

		if(!empty($_POST['sub'])){
			$title = $_POST['title'];
			$con = $_POST['con'];
			$username = $_COOKIE['username'];
			$selectsql= "SELECT `userid` FROM user WHERE `username`= '$username'";
			$select_query = mysql_query($selectsql);
			$userid_array = mysql_fetch_array($select_query);
			$userid = $userid_array['userid'];
			echo $userid;
			$sql = "INSERT INTO `article`(`article_id`,`userid`, `title`, `dates`, `contents`) VALUES (null,'$userid','$title',now(),'$con')";
			if(mysql_query($sql)) echo "操作成功";
			else echo "操作失败";
		}
	}else{
	echo '<a href="../weibo/login.php"><img src="resource/login_normal.png"></a>';
}
?>

<form id="form" action="add.php" method="post">
标题<input type="text" name="title"></br>
内容<textarea rows="5" cols="50" name="con"></textarea></br>
<input type="submit" name="sub" value="发表">
</form>


</body>
</html>