<?php
	error_reporting(E_ALL ^ E_DEPRECATED ^E_NOTICE);
	mysql_connect("localhost:3306","root","4xg.njn,ac7d")or die("mysql连接失败");
	mysql_select_db("diandi")or die("db连接失败");
	mysql_query("set names 'utf8'");
?>
