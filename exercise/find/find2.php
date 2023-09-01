<?php
if($_POST['submit2']=='submit2'){
				$username2=$_POST['username'];
				$cookie=$_COOKIE['access'];
				if(md5(md5(md5($username2))) == $cookie){
					//exit("您在尝试越权更改他人账号！");
				
				$pass1=$_POST["userpass"];
				$pass2=$_POST["newpass"];
				if($pass1==$pass2){
					include "./connectdb.php";
					$sql_change_password="UPDATE user SET password='".$pass1."' WHERE name='".$username2."'";
					$re8=mysqli_query($link,$sql_change_password);
					if(!$re8=mysqli_query($link,$sql_change_password)){
						exit("更改失败！");
					}
					echo "更改成功，<a href='../login_post.html'点此重新登陆</a>！";
					include "./closedb.php";
				}else{
					exit("两次密码输入不一致！<a href='./find.html'>重试！</a>");
				}
			}else{
				echo "ILLEGAL";
			}
			}else{
				exit("请通过表单提交");
			}
?>