<!DOCTYPE html>
<html>
<head>

<?php
	include("connect.php");//引入连接数据库
	if(!empty($_GET['viewid'])){
		$article_sql = "select * from article where `article_id` = '".$_GET['viewid']."'";
		$query = mysql_query($article_sql);
		$rs = mysql_fetch_array($query);

		$userid = $rs['userid'];
		$author_sql = "select * from user where `userid` = '$userid'";
		$query = mysql_query($author_sql);
		$author_rs = mysql_fetch_array($query);
		$author = $author_rs['username'];
	}
?>
  <title><?php echo $rs['title']?>-点滴</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="view.css">
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

<div id="main">
	<div id="article">
	    <h1><?php echo $rs['title']?></h1>
		<div id="author"><a href="personal.php?name=<?php echo $author; ?>"><?php echo $author; ?></a></div>
	<?php echo $rs['contents']?> 
	</div>
</div>
</body>
</html>