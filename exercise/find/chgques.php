<meta charset="utf-8">
<?php
if(isset($_COOKIE['name'])){
	$sql_check_cookie="SELECT name FROM user WHERE cookie='".$_COOKIE['name']."'";
	include "./connectdb.php";
	$re1=mysqli_query($link,$sql_check_cookie);
	if(!$re1=mysqli_query($link,$sql_check_cookie)){
		exit("查询错误！");
	}
	$re2=mysqli_num_rows($re1);
	if($re2>=1){
		include "./closedb.php";
		if(isset($_POST['submit'])&&$_POST["submit"]=="submit"){
			if(is_null($_POST["username123"])||is_null($_POST['userpass123'])){
				exit("用户名或密码为空！");
			}else{
				$username_1=$_POST["username123"];
				$password_1=$_POST["userpass123"];
				if(substr($username_1,0,1)==' '||substr($password_1, 0,1)==' '){
					exit("输入的用户名与密码不能是空格！");
				}else{
					$sql_check_user_name="SELECT cookie FROM user WHERE name='".$username_1."' AND password='".$password_1."'";
					include "./connectdb.php";
					$re11=mysqli_query($link,$sql_check_user_name);
					if(!$re11=mysqli_query($link,$sql_check_user_name)){
						exit("查询错误！");
					}
					$re22=mysqli_num_rows($re11);
					if($re22>=1){
						if(md5(md5(md5($username_1)))==$_COOKIE['name']){
							setcookie("change_access",md5($username_1),time()+3600);
							echo "身份验证成功！点此<a href='./chgques2.html'>继续修改密保问题</a>";
						}else{
							exit("您的操作不合法，可能为越权操作！<a href='./chgques.html'>重试</a>");
						}
					}else{
						exit("用户名或密码错误！<a href='./chgques.html'>点此重试</a>");
					}
				}
			}
		}else{
			exit("请通过表单提交！<a href='../chgques.html'>重新尝试</a>");
		}
	}else{
		include "./closedb.php";
		exit("cookie非法!<a href='../login_post.html'>重新登录！</a>");
	}
}else{
	echo "<a href='../login_post.html'>验证失败，请登陆</a>";
}
?>