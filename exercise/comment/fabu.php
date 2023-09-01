<meta charset="utf-8">
<?php
include "./connect_con.php";
if(isset($_COOKIE['name'])){
	$sql_get_username="SELECT name,cookie FROM user WHERE cookie="."'".$_COOKIE['name']."'";
	if(!mysqli_query($link,$sql_get_username)){
		echo "查询错误！";
	}
	$re1=mysqli_query($link,$sql_get_username);
	$re2=mysqli_fetch_assoc($re1);
	if($_COOKIE['name']!=$re2['cookie']){
		exit("cookie非法！");
	}else{
         echo<<<HTML
         <head>
         <style type='text/css'>
         #zym666{background-color: black;text-align: center;}
         </style>
         </head>
             <script type="text/javascript" src="../../jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
         <body>
         <div id='zym666'>
		<form action="fabu.php"
	method="post"
	target="_self">
		<font color='red' size='15px'>您的用户名：</font><input type='text' name="username">
		<br /><font color='yellow' size='15px'>您留言的标题：</font><input type='text' name="usertitle"><br />
		<font color='green' size='15px'>您留言的正文：</font><br /><textarea name="userwrite" ></textarea><br />
		<font color='red' size='15px'>点此提交</font>
		<input type="submit" name="submit" value="post">
	</form>
	</div>
	</body>
HTML;
	if(isset($_POST['submit'])&&isset($_POST['usertitle'])&&isset($_POST['username'])){
		$userinputname=$_POST['username'];
		$usertitle=$_POST['usertitle'];
		$userwrites=$_POST['userwrite'];
		if($re2['name']!=$userinputname){
			exit("您提交留言的用户名不合法，请重新<a href='fabu.php'>提交</a>");
		}
		if($usertitle=='' || $userwrites==''){
			exit("提交留言题目或内容不能为空！");
		}
		if(substr($userwrite,0,1)==' ' || substr($usertitle,0,1)==' '){
			exit("提交留言题目或内容开头不能包含空格");
		}
		$sql_save_comment="INSERT INTO usercontents(username, content, `date`, cookie, msg) VALUES "."('".$userinputname."','".$usertitle."','".date("Y-m-d",time())."','".$re2['cookie']."','".$userwrites."')";
		if(!mysqli_query($link,$sql_save_comment)){
			exit("插入错误！");
		}
		echo"发布成功！<a href='./comment.php'>点此查看留言</a>";
	}else{
		exit("<script>alert('您好像少提交了用户名或题目')</script>");
	}
	}
}else{
	echo "您还未<a href='../login_post.html'>登录</a>";
}
?>