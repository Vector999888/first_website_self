<?php
if(isset($_COOKIE['change_access'])){
	if(isset($_POST['username456']) && isset($_POST['UserQues']) && isset($_POST['Answer']) && isset($_POST['UserQues2'])&& isset($_POST['Answer2'])){
		if(substr($_POST['username456'],0,1)==' ' || substr($_POST['UserQues'],0,1)==' ' || substr($_POST['Answer'],0,1)==' ' || substr($_POST['UserQues2'],0,1)==' ' || substr($_POST['Answer2'],0,1)==' '){
			exit("你输入的表单有些项目为空");
		}else{
			$username456=$_POST['username456'];
			$UserQues=$_POST['UserQues'];
			$Answer=$_POST['Answer'];
			$UserQues2=$_POST['UserQues2'];
			$Answer2=$_POST['Answer2'];
			if($_COOKIE['change_access']==md5($username456)){
				$data=array($username456 , $UserQues , $UserQues2 , $Answer , $Answer2);
				for($i=0;$i<5;$i++){
					for($j=0;$j<10;$j++){
					$data[$i]=base64_encode($data[$i]);
				}
				}
				$sql_update_ques="UPDATE questions SET question='".$data[1]."' , question2='".$data[2]."', answer='".$data[3]."', answer2='".$data[4]."' WHERE username='".$data[0]."'";
				include "./connectdb.php";
				$re1=mysqli_query($link,$sql_update_ques);
				if(!$re1=mysqli_query($link,$sql_update_ques)){
					exit("执行错误!");
				}
				include "./closedb.php";
				echo "更改成功！<a href='../self/yourself.php'>点此回到主页</a>";
			}else{
				exit("cookie非法或越权操作！");
			}

		}
	}else{
		exit("有些项目为空");
	}
}else{
	exit("您没有相应权限！");
}
?>