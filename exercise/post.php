<meta charset="utf-8">
<?php
include "./connect.php";
$userName=$_POST['username'];
$userPass=$_POST['userpass'];
$sql_check="select name,password from user where name="."'".$userName."'"." and password="."'".$userPass."'";
if(!mysqli_query($link,$sql_check)){
	exit("查询错误！");
}
$re2=mysqli_query($link,$sql_check);
$rows=mysqli_num_rows($re2);
if(isset($_POST['usersubmit'])){
	if($rows==1){
		setcookie('name',md5(md5(md5($userName))));
		$cookie_save=md5(md5(md5($userName)));
		$sql_save_cookie="UPDATE user SET cookie="."'".$cookie_save."'"." WHERE name="."'".$userName."'";
		if(!mysqli_query($link,$sql_save_cookie)){
			exit("查询出错!");
		}
		echo "登陆成功!";
		include "./close.php";
		header("Location:./self/yourself.php");
	}else{
		 include "./close.php";
		 exit("登录失败,<a href='login_post.html'>点此重试</a>");
	}
}else{
	echo "Error<a href='login_post.html'>通过表单提交</a>";
}
?>