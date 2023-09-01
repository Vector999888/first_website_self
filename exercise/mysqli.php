<?php
$servername = "localhost";
$username = "adminzym";
$password = "zym856460.";
$dbname = "adminzym";
$link=mysqli_connect($servername,$username,$password,$dbname);
if(!$link){
	echo mysqli_connect_error();
}
$sql="select * from user";
$result=mysqli_query($link,$sql);
if($result=mysqli_query($link,$sql)){
}else{
	echo mysqli_error($link);
}
$res=mysqli_fetch_all($result);
var_dump($res);
mysqli_close($link);
?>