<?php
session_start();
include('../connect.php');
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
	$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	$uid_get = $c->get_uid();
	$uid = $uid_get['uid'];
	$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
	$username = $user_message["screen_name"];
	
	$cookie_condition = ($_COOKIE['username'] && $_COOKIE['confirm']);
	if($cookie_condition){
		echo $_COOKIE['username'].'您好，您已经登陆,正在跳转至首页……'; 
		echo '<script>location.href="../index.php"</script>';
	}else{
		$weibokey = $_SESSION['token']['access_token'];
		$sql = "SELECT * FROM `user` WHERE `weibokey`='$weibokey'";
		$row = mysql_query($sql);
		$user_condition = mysql_fetch_array($row);
		if(!empty($user_condition)){
			//从刚才查询里读出username，同时生成confrim
			//$username = ;
			$confirm = (userid*22) . $username;
			setcookie('username', $username, time()+7200,'/');
			setcookie('confirm', $confirm, time()+7200,'/');
			
			$sql = "SELECT * FROM `user` WHERE `weibokey`='$weibokey'";
			$row = mysql_query($sql);
			$user_info_condition = mysql_fetch_array($row);

			if(empty($user_info_condition['avatar'])){
				$avatar = $user_message["avatar_large"];
				$sql = "UPDATE  `diandi`.`user` SET  `avatar` =  '$avatar' WHERE  `user`.`weibokey` ='$weibokey'";
				$row = mysql_query($sql);
			}
			if(empty($user_info_condition['description'])){
				$description = $user_message["description"];
				$sql = "UPDATE  `diandi`.`user` SET  `description` =  '$description' WHERE  `user`.`weibokey` ='$weibokey'";
				$row = mysql_query($sql);
			}

			echo "登陆成功，正在跳转至首页……";
			echo '<script>location.href="../index.php"</script>';
		}else{
			$sql = "INSERT INTO `user`(`userid`, `username`, `weibokey`) VALUES (null, '$username', '$weibokey')";
			//	插入微博名作为用户名,和微博key,完成后生成confrim
			//$username = ;
			$sql2 = "SELECT * FROM `user` WHERE `weibokey`='$weibokey'";
			$row = mysql_query($sql);
			$user_condition = mysql_fetch_array($row);
			$userid = $$user_condition['userid'];
			$confirm = (userid*22) . $username;
			setcookie('username',$username,time()+7200,'/');
			setcookie('confirm',$confirm,time()+7200,'/');
			
						$sql = "SELECT * FROM `user` WHERE `weibokey`='$weibokey'";
			$row = mysql_query($sql);
			$user_info_condition = mysql_fetch_array($row);

			if(empty($user_info_condition['avatar'])){
				$avatar = $user_message["avatar_large"];
				$sql = "UPDATE  `diandi`.`user` SET  `avatar` =  '$avatar' WHERE  `user`.`weibokey` ='$weibokey'";
				$row = mysql_query($sql);
			}
			if(empty($user_info_condition['description'])){
				$description = $user_message["description"];
				$sql = "UPDATE  `diandi`.`user` SET  `description` =  '$description' WHERE  `user`.`weibokey` ='$weibokey'";
				$row = mysql_query($sql);
			}
			
			echo "注册成功，正在跳转至首页……";
			echo '<script>location.href="../index.php"</script>';
		}
	}
?>