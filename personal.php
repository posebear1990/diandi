<!Doctype html>
<?php
	include("connect.php");//引入连接数据库
	if(!empty($_GET['name'])){
		$sql = "select * from user where `username` = '".$_GET['name']."'";
		$query = mysql_query($sql);
		$rs = mysql_fetch_array($query);
		$userid = $rs['userid'];
	}
?>
<html>
<head>
	<title><?php echo $rs['username']?>-点滴</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="personal.css">
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
<div id ="personal">
	<div id="name"><?php echo $rs['username']?></div>
	<div id="logo">
		<img src="
			<?php 
			if(!empty($rs['avatar'])){
				echo $rs['avatar'];
			}else{
				echo "resource/default_avatar.jpg";
			}	
		?>">	
	</div>
	<div id="intro">
	<p>
<?php
	if(!empty($rs['description'])){
		echo $rs['description'];
	}else{
		echo "该用户还未填写自我介绍";
	}
?></p>
	</div>
</div>
</header>

<div id="main">
	<article>
		<?php
			include("connect.php");

			$sql = "SELECT * FROM  `article` where `userid` = '$userid' ORDER BY  `article`.`dates` DESC LIMIT 0 , 10";
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
	<div class="attr">作者：<?php echo $username; ?> 日期：<?php echo $resource['dates'];?> 
<!--		<a href="edit.php?edit=<?php echo $resource['article_id']?>">编辑</a>
		<a href="del.php?del=<?php echo $resource['article_id'];?>">删除</a>
-->
	</div>
	<?php } ?>
	</article>
	<footer>
		关于点滴
	</footer>
</div>
</body>
</html>
