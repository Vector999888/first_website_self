<meta charset="UTF-8">
<?php
$userinputname=$_POST['username'];
if(isset($_COOKIE)&&$_COOKIE['name']==md5(md5(md5($userinputname)))){
	echo "<p>欢迎！{$userinputname}</p>"."<a href='logout.php'>注销</a><br />";
	echo "<a href='comment/comment.php'>点此进入留言板</a>";
}
else{
	echo '<a href="login_post.html">请登录</a>';}
?>