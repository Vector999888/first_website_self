<meta charset="utf-8">
<?php
include "./connect.php";
if(isset($_POST['usersubmit'])){
			$userName=$_POST['username'];
			$userpass1=$_POST['userpass'];
			$userpass2=$_POST['repass'];
			if(
				isset($userName)&&isset($userpass1)&&isset($userpass2)&&
				$userpass2===$userpass1
			){
				$sql_check="SELECT name FROM user WHERE name="."'".$userName."'";
				$res=mysqli_query($link,$sql_check);
				if (mysqli_num_rows($res)!=0){
					die("您的用户名已经注册，请更换后<a href='https://www.zymiesafe.com/exercise/register.html'>重试</a>！");
				}
				$sql="insert into user(name,password) values ('".$userName."','".$userpass1."')";
				if(!mysqli_query($link,$sql)){
					exit("mysql语句有误");
				}else{
					echo "注册成功！<a href='https://www.zymiesafe.com/exercise/self/yourself.php'>返回个人中心</a>";
					setcookie("name",md5(md5(md5($userName))));
					$cookie_save=md5(md5(md5($userName)));
					$sql_save_cookie="UPDATE user SET cookie="."'".$cookie_save."'"." WHERE name="."'".$userName."'";
					if(!mysqli_query($link,$sql_save_cookie)){
						exit("查询出错！");
					}
				}
			}else{
				echo "注册信息有误，请重新输入<a href='https://www.zymiesafe.com/exercise/register.html'></a>";
			}
}else{
	header("Location:https://www.zymiesafe.com/exercise/register.html");
}
include "./close.php";
?>