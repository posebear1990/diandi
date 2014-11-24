<!Doctype html>
<html>
<head>
	<title>点滴：连接一生点滴</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="default.css">
</head>
<body>

<nav>
	<div class="head">
		<a href="index.php">首页</a>
	</div>

	<div class="login">
	<?php
	$cookie_condition = ($_COOKIE['username'] && $_COOKIE['confirm']);
		if($cookie_condition){
			$username = $_COOKIE['username'];
			echo "<a href=personal.php?name=$username><img src=resource/login_normal.png></a>";
		}else{
			echo '<a href="../weibo/login.php"><img src="resource/login_normal.png"></a>';
			echo $_COOKIE['username'];
		}
	?>
	</div>
</nav>

<header>
	<h1>点 滴</h1>
	<h2>一生源自点滴</h2>
<?php
	if($cookie_condition){
		echo '<a href="ueditor/add.php">写一篇新文章</a>';
	}else{
		echo '<a href="../weibo/login.php">写一篇新文章</a>';
	}
?>
</header>

<div id="main">
	<article>
	<?php
		include("connect.php");

		$sql = "SELECT * FROM  `article` ORDER BY  `article`.`dates` DESC LIMIT 0 , 10";
		$query = mysql_query($sql);
		while($resource = mysql_fetch_array($query)){
	?>
	<h1><a href="view.php?viewid=<?php echo $resource['article_id']?>"><?php echo $resource['title'];?></a></h1>
	<div class="arti"><?php echo iconv_substr($resource['contents'],0,145,"utf-8")."......";?></div>
	<?php
		$userid = $resource['userid'];
		$selectsql= "SELECT username FROM  `user` WHERE  `userid` = $userid";
		$select_query = mysql_query($selectsql);
		$username_array = mysql_fetch_array($select_query);
		$username = $username_array['username'];
	?>
	<div class="attr">作者：<a href=personal.php?name=<?php echo $username; ?> ><?php echo $username; ?></a> 日期：<?php echo $resource['dates'];?> 
<!--		<a href="edit.php?edit=<?php echo $resource['article_id']?>">编辑</a>
		<a href="del.php?del=<?php echo $resource['article_id'];?>">删除</a>
-->
	</div>
	<?php } ?>
	</article>
	<footer>
		<a href="http://diandiandidi.me/view.php?viewid=18">关于点滴</a>
	</footer>
</div>
</body>
</html>
