<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>写一篇文章-点滴</title>
	<meta charset="utf-8">
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
    <style type="text/css">
		body{
			background-color: #e7ebd2;
		}
        div{
            width:100%;
        }
    </style>
</head>
<body>

<?php
	$cookie_condition = ($_COOKIE['username'] && $_COOKIE['confirm']);
	if($cookie_condition){
		include("../connect.php");//引入连接数据库

		if(!empty($_POST['sub'])){
			$title = $_POST['title'];
			$con = $_POST['con'];
			$username = $_COOKIE['username'];
			$selectsql= "SELECT `userid` FROM user WHERE `username`= '$username'";
			$select_query = mysql_query($selectsql);
			$userid_array = mysql_fetch_array($select_query);
			$userid = $userid_array['userid'];
			$sql = "INSERT INTO `article`(`article_id`,`userid`, `title`, `dates`, `contents`) VALUES (null,'$userid','$title',now(),'$con')";
			if(mysql_query($sql)) echo '操作成功，正在跳转到跳转到首页……<script>location.href="/weibo/login.php"</script>';
			else echo "操作失败";
		}
	}else{
		echo '<script>location.href="/weibo/login.php"</script>';
	}
?>

<div>
    <h1>安安静静写篇文章吧</h1>
	<form id="form" action="add.php" method="post">
	</form>
	<script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
</div>


<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');

    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }

    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }
    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }
	function submit() {
		var form = document.getElementById("form");
		var contents = UE.getEditor('editor').getContent();
		form.innerHTML = '<textarea style="display:none"rows="0" cols="0" name="con">' + contents + '</textarea>'+'<div style = "width: 400px; height: 150px;display: block;position: fixed;left: 36%; top: 5%;font-family: 宋体;	text-align: center;		color: #547834;	background-color: #fff;	width: 360px; height: 400px;padding-top:100px;border: 0;			text-shadow:0.02em 0.02em 0.1em #777777;			border-radius: 10px;box-shadow: 0px 0px 6px 3px #777; z-index:1000;"><p>确认发表吗?</p><p>目前发表之后无法修改和删除</p><p>起个标题，然后发表</p><input type="text" name="title">(标题)</br><input type="submit" name="sub" value="发表"></div>';
	}
</script>
<div id="btns">
        <button onclick="submit()">写好了</button>
</div>
</body>
</html>