<meta charset="utf-8">
<?php
if(isset($_POST['submit']) && $_POST['submit']=='submit'){
	session_start();
	$captcha_post=$_POST['captcha'];
	$captcha_session=$_SESSION['captcha'];
	//var_dump($captcha_session);
	//var_dump($captcha_post);
	if($captcha_post!=$captcha_session){
        session_destroy();
		exit("验证码错误！<a href='admin.html'>点此重试</a>");
	}else{
		if($_POST['username666']=='' || $_POST['password666']==''){
			exit("输入用户名或密码为空");
		}
		if(substr($_POST['username666'],0,1)==' ' || substr($_POST['password666'],0,1)==' '){
			exit("输入的用户名或密码不能包含空格");
		}
		session_destroy();
        //只是清除session值，会导致验证码为空时可爆破，应该把19行代码下方进行非空判定
        //if($captcha_post==''){
        //exit("非法操作!");
        //}
		$username666=$_POST['username666'];
		$password666=$_POST['password666'];
		//没用PDO预编译的$sql_check_admin="SELECT * FROM admin WHERE name='".$username666."' AND password='".$password666."'";
		//include "conn.php";
		$dbms='mysql';     //数据库类型
		$host='localhost'; //数据库主机名
		$dbName='adminzym';    //使用的数据库
		$user345='adminzym';      //数据库连接用户名
		$pass345='zym856460.';          //对应的密码
		$dsn="$dbms:host=$host;dbname=$dbName;charset=utf8";
		try{
		$pdo=new PDO($dsn,$user345,$pass345);
		$sql_check_admin="SELECT * FROM admin WHERE name=? AND password=?";
		$res345=$pdo->prepare($sql_check_admin);
		$res345->bindParam(1,$username666);
		$res345->bindParam(2,$password666);
		$res345->execute();
		$num=$res345->rowCount();
		if($num>=1){
			echo "成功登录";
		}else{
			echo "登陆失败！";
		}
		
		}catch(PDOException $e){
			die("Error!: " . $e->getMessage() . "<br/>");
		}
	}
}else{
	exit("请用表单登录,3秒后跳转到登录页面");
	sleep(3);
	header("Location:admin.html");
}

?>