<meta charset="utf-8">
<?php
include "./connect.php";
if(isset($_POST['usersubmit'])){
	if((!isset($_POST["username"])||(!isset($_FILES['userfile']['tmp_name'])))){
			exit("RETRY!用户名或文件为空");
	}else{
			$userinput=$_POST['username'];
			$tmp_path=$_FILES['userfile']['tmp_name'];
			$path=__DIR__."\\".$_FILES['userfile']['name'];
			$sql_check_username="select name from user where name="."'".$userinput."'";
			if(!mysqli_query($link,$sql_check_username)){
				exit("FAILED TO CONTROL THE DATABASE!");
			}
			$re1=mysqli_query($link,$sql_check_username);
			$re2=mysqli_num_rows($re1);
			if($re2==1){
				move_uploaded_file($tmp_path,$path);
				$sql_save_photo="UPDATE user SET photo ="."'".$path."'"."WHERE name="."'".$userinput."'";
				if(!mysqli_query($link,$sql_save_photo)){
					exit("查询添加失败！");
				}
				echo "成功上传";
				echo "您的图片名：{$_FILES['userfile']['name']}";
			}else{
				exit("FAILED");
			}
	}
}else{
	header("Location:https://www.zymiesafe.com/exercise/upload.html");
}
include "./close.php";
?>