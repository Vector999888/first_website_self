<meta charset="utf-8">
<?php
if(!isset($_POST['usersubmit'])){
	header("Location:logout.html");
}else{
	$userinputname=$_POST['username'];
if(isset($_COOKIE)&&$_COOKIE['name']===md5(md5(md5($userinputname)))){
setcookie('name',md5(md5(md5($userinputname))),time()-3600);
		echo "注销成功！";
        sleep(30);
        header("location:index.php");
		}else{
	echo "您的操作不合法，重新<a href='login_post.html'>登陆</a>";
}}
?>