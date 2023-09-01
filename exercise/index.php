<html>
<head>
	<meta charset="utf-8">
	<title>
		zym的自建安全论坛
	</title>
    <script type="text/javascript" src="../jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<style type="text/css">
	#zym123{color: red;background-color: whitesmoke;font-size: 35px; margin: auto;text-align: center;}
	#zym456{color: yellow;background-color: red;font-size: 35px; margin: auto;text-align: center;}	
	</style>
</head>
<body>
	<font color="red" size="17px">欢迎来到此论坛，您可以在此畅所欲言！</font>
	<br />
	<button class="btn-lg" type="button" onclick="message()" >点此查看公告！！</button>
	<br/>
	<font color="green" size="35px"></font>
    <div id="zym689"></div>
	<script>
		function message(){
			var a = document.getElementsByTagName('font');
			a[1].innerHTML='公告:本站内所有表单提交处严禁使用任何单引号及其他与sql语句有关的特殊符号！';
            var c=document.getElementById('zym689');
            var d=document.createElement('button');
            d.type="button";
            d.onclick=close;
            d.className="btn-lg";
            d.innerText="点此关闭公告";
            c.appendChild(d);
		}
        function close(){
            var e=document.getElementsByTagName("font");
            e[1].innerHTML='';
        }
	</script>
	<br>
<div id='zym123'>
	<a  href="./register.html" >
	注册</a>
</div>
	<br />
<div id='zym456'>
	<a  href="./login_post.html" >已有账号？点此登录</a>
	<a  href='./admin/admin.html'>管理员登录</a>
</div>
	<br />
</body>
</html>