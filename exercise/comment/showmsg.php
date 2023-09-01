<html>
<meta charset="utf-8">
<head>
	<title>
		查看详细留言界面
	</title>
	<style type="text/css">
		#zym666{background-color: black;text-align: center;}
	</style>
</head>
<script type="text/javascript" src="../../jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
<body>
<?php
include "./connect_con.php";
if(isset($_GET['username'])){
	$username=$_GET['username'];
	$sql_get_msg="SELECT content,msg,username,`date` FROM usercontents WHERE username="."'".$username."'";
	if(!mysqli_query($link,$sql_get_msg)){
		exit("ERROR DATABASE CONNECT!");
	}
	$re1=mysqli_query($link,$sql_get_msg);
	$re8=mysqli_num_rows($re1);
	echo "<div id='zym666'>";
	while($re2=mysqli_fetch_assoc($re1)){
	echo "<font color='red' size='15px'>".$re2['username']."</font>"." "."<font color='red' size='15px'>:</font>"." "."<font color='yellow' size='15px'>".$re2['content']."</font>"."<hr />"."<font color='green' size='15px'>".$re2['date']."</font>"."<br />";
	echo "<font color='yellow' size='10px'>"."正文内容："."</font>"."<br />"."<font color='yellow' size='5px'>".$re2['msg']."</font>"."<br /><hr />";
	}
	echo "</div>";
}else{
	echo "ERROR! NO username!";
}




include "./close_con.php";
?>
</body>
</html>