<html>
<head>
	<meta charset="utf-8">
	<title>留言板首页</title>
</head>
<script type="text/javascript" src="../../jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
<body>
	<h1>zym留言板</h1>
<?php
include "./connect_con.php";
if(!isset($_COOKIE['name'])){
	exit("<a href='../login_post.html'>点此登录</a>");
	}
$sql_get_cookie="SELECT cookie FROM user WHERE cookie="."'".$_COOKIE['name']."'";
if(!mysqli_query($link,$sql_get_cookie)){
	exit("查询失败！");
}
$re1=mysqli_query($link,$sql_get_cookie);
$re2=mysqli_num_rows($re1);
if($re2!=1){
	exit("cookie非法！<a href='../login_post.html'>重新登录</a>");
}
echo "<a class='btn-lg' href='fabu.php'>点此发布留言</a>";
$sql_get_username="SELECT name FROM user WHERE cookie="."'".$_COOKIE['name']."'";
if(!mysqli_query($link,$sql_get_username)){
	exit("查询失败！");
}
$re3=mysqli_query($link,$sql_get_username);
$re_name=mysqli_fetch_assoc($re3);
echo "<font color='red' size='15px'>欢迎您，"."'".$re_name['name']."'"."</font><hr />";
$sql_find_comments="SELECT username,content,`date` FROM usercontents";
if(!mysqli_query($link,$sql_find_comments)){
	exit("查询错误！");
}
$re6=mysqli_query($link,$sql_find_comments);
if(mysqli_num_rows($re6) <= 0){
	echo "暂无留言";
}else{
	echo "<table class='table' border=4>";
	echo "<tr class='info'><td>username</td><td>content</td><td>`date`</td></tr>";
	while($result=mysqli_fetch_assoc($re6)){
		//var_dump($result);
		echo "<tr class='active'><td>{$result['username']}</td><td><a class='btn-lg' href='showmsg.php?username={$result['username']}' target='_blank'>{$result['content']}</a></td><td>{$result['date']}</td></tr>";
	}
	echo "</table>";
}
include "./close_con.php";
?>
</body>
</html>