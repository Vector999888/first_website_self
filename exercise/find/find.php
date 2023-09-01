<meta charset="utf-8">
<?php
if(isset($_POST['submit'])&&$_POST['submit']=='submit'){
	$username1=$_POST['username'];
	$userques=$_POST['userques'];
	$answer=$_POST['answer'];
	$userques2=$_POST['userques2'];
	$answer2=$_POST['answer2'];
	if(substr($username1,0,1)==' ' || substr($userques,0,1)==' ' || substr($answer,0,1)==' ' || substr($userques2,0,1)==' ' || substr($answer2,0,1)==' '){
		exit("您提交的表单里面开头有空格");
	}else{
		$sql_check_username="SELECT name FROM user WHERE name='".$username1."'";
		include "./connectdb.php";
		$re1=mysqli_query($link,$sql_check_username);
		if(!$re1=mysqli_query($link,$sql_check_username)){
			exit("查询错误！");
		}
		$re2=mysqli_num_rows($re1);
		if($re2>=1){
			echo "用户名存在！";
			$data=array($userques,$answer,$userques2,$answer2);
			for($q=0;$q<4;$q++){
				for($w=0;$w<10;$w++){
					$middle=base64_encode($data[$q]);
					$data[$q]=$middle;
				}
			}
			$sql_check_questions="SELECT question,answer,question2,answer2 FROM questions WHERE question='".$data[0]."' AND answer='".$data[1]."' AND question2='".$data[2]."' AND answer2='".$data[3]."'";
			$re12=mysqli_query($link,$sql_check_questions);
			if(!$re12=mysqli_query($link,$sql_check_questions)){
				exit("查询错误！");
			}
			$re13=mysqli_num_rows($re12);
		  if($re13<1){
		  	exit("密保问题错误，<a href='find.html'>点此重试</a>");
		  }
		setcookie('access',md5(md5(md5($username1))));
		echo "<a href='find2.html'>点此继续修改密码</a>";
			
		}else{
			exit("请再次检查您要找回的用户名，<a href='find.html'>点此重试</a>");
		}
	}
}else{
	exit("用表单提交！");
}


?>