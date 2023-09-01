<?php
$servername = "localhost";
$username = "adminzym";
$password = "zym856460.";
$dbname = "adminzym";
$link=mysqli_connect($servername,$username,$password,$dbname);
if(!$link=mysqli_connect($servername,$username,$password,$dbname)
){
	die(mysqli_connect_error());
}
?>