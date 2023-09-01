<meta charset="utf-8">
<?php
if(isset($_COOKIE['name'])){
	include "./connectdb.php";
	$sql_check_cookie="SELECT name FROM user WHERE cookie='".$_COOKIE['name']."'";
	$re3=mysqli_query($link,$sql_check_cookie);
	if(!$re3=mysqli_query($link,$sql_check_cookie)){
		exit("查询错误！");
	}
	$re5=mysqli_num_rows($re3);
	if($re5>=1){
		if(md5(md5(md5($_POST['username'])))==$_COOKIE['name']){
if(isset($_POST['submit'])){
	if($_POST['submit']=='ok'){
		if(isset($_POST['username'])&&isset($_POST['userques'])&&isset($_POST['answer'])&&isset($_POST['userques2'])&&isset($_POST['answer2'])){
			$username=$_POST['username'];
			$userques=$_POST['userques'];
			$answer=$_POST['answer'];
			$userques2=$_POST['userques2'];
			$answer2=$_POST['answer2'];
			if(substr($username,0,1)==' ' || substr($userques,0,1)==' ' || substr($answer,0,1)==' ' || substr($userques2,0,1)==' ' || substr($answer2,0,1)==' '){
				exit("你传入的密保问题与答案好像有开头的空格，请重试");
			}else{
				$data=array($username,$userques,$answer,$userques2,$answer2);
				for($m=0;$m<5;$m++){
					for($i=0;$i<10;$i++){
						$middle=base64_encode($data[$m]);
						$data[$m]=$middle;
					}
				}			//10次对称加密
				include "./connectdb.php";
				$sql_check_num_ques="SELECT username FROM questions WHERE username='".$data[0]."'";
				if(!$result123=mysqli_query($link,$sql_check_num_ques)){
					exit("查询错误！");
				}
				$result456=mysqli_num_rows($result123);
				if($result456>1){
					exit("此用户已经设置了密保问题！");
				}
				$sql_save_question="INSERT INTO questions(username,question,answer,question2,answer2) VALUES("."'".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."'".")";
				if(!$sqli=mysqli_query($link,$sql_save_question)){
					exit("插入错误！");
				}else{
					echo "<a href='../self/yourself.php'>密保问题设置成功！点此返回！</a>";
					include "./closedb.php";
				}

			}
		}else{
			exit("<a href='./setques.html'>重试,有些参数未设置</a>");
		}
	}else{
		exit("submit值提交错误<a href='./setques.html'>重试</a>");
	}
}else{
	exit("<a href='./setques.html'>请通过表单登录</a>，没传submit参数哦！");
}
}else{
	exit("您在尝试非法的越权操作！这可能威胁他人账号安全！");
}
}else{
	exit("cookie非法！");
}
}else{
	exit("无cookie，可能造成越权更改！");
}
?>