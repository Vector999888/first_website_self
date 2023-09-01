<?php
$host = "localhost";
$username = "adminzym";
$password = "zym856460.";
$dbname = "adminzym";
$link=mysqli_connect($host,$username,$password,$dbname);
if(!$link=mysqli_connect($host,$username,$password,$dbname)){
	echo "数据库关闭时连接错误！";
}
mysqli_close($link);
?>