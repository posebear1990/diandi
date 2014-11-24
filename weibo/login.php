<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
?>

<html>
<head>
	<title>登陆-点滴</title>
	<meta charset="utf-8">
<style>
	body{
		background-color: #e7ebd2;
	}
		#login {
			display: block;
			position: fixed;
			left: 36%; top: 10%;
			font-family: 宋体;
			text-align: center;
			color: #547834;
			background-color: #fff;
			width: 360px; height: 500px;
			border: 0;
			text-shadow:0.02em 0.02em 0.1em #777777;
			border-radius: 10px;
			box-shadow: 0px 0px 6px 3px #777;

		}
		#login img{
			margin-top: 200px;
			margin-bottom: 95px;
		}
</style>
</head>
<body>
<div id="login">
		<a href="<?php echo $code_url; ?>"><img src="../resource/weibo_login.png"></a>
	<p>新浪微博一步登录</p>
</div>
<body>
</html>