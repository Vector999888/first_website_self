<?php
$dbms652314='mysql';     //数据库类型
$host853694='localhost'; //数据库主机名
$dbName965752='adminzym';    //使用的数据库
$user345632='adminzym';      //数据库连接用户名
$pass345='zym856460.';          //对应的密码
$dsn653241="$dbms652314:host=$host853694;dbname=$dbName965752;charset=utf8";
try{
    $pdo=new PDO($dsn653241,$user345632,$pass345);
}catch(PDOException $error){
    die("Error!: " . $error->getMessage() . "<br/>");
}