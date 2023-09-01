<?php
if(isset($_GET['num'])&&$_GET['num']>=0){
/*

* 数字验证码生成

*/

// 开启session

session_start();

//1.创建黑色画布

$image = imagecreatetruecolor(100, 30);



//2.为画布定义(背景)颜色

$bgcolor = imagecolorallocate($image, 255, 255, 255);



//3.填充颜色

imagefill($image, 0, 0, $bgcolor);



// 4.设置验证码内容



//4.1 定义验证码的内容

$content = "0123456789";



//4.1 创建一个变量存储产生的验证码数据，便于用户提交核对

$captcha = "";

for ($i = 0; $i < 4; $i++) {

// 字体大小

$fontsize = 10;

// 字体颜色

//$fontcolor = imagecolorallocate($image, mt_rand(0,20), mt_rand(0,20), mt_rand(0, 20));
$fontcolor = imagecolorallocate($image,0,0,0);

// 设置字体内容

$fontcontent = substr($content, mt_rand(0, strlen($content)-1), 1);

$captcha .= $fontcontent;

// 显示的坐标

$x = ($i * 100 / 4) + mt_rand(5, 10);

$y = mt_rand(5, 10);

// 填充内容到画布中

imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);

}

$_SESSION["captcha"] = $captcha;

//5.向浏览器输出图片头信息

header('content-type:image/png');

//6.输出图片到浏览器

imagepng($image);

//7.销毁图片

imagedestroy($image);

}
?>