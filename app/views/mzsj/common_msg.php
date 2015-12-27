<!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="utf-8" />
	<title><?php echo $title;?></title>
	<meta name="author" content="李潇喃：www.muzisheji.com" />
	<!-- IE最新兼容 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- 国产浏览器高速 -->
	<meta name="renderer" content="webkit">
	<!-- 移动设备禁止缩放 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!-- No Baidu Siteapp-->
	<meta http-equiv="Cache-Control" content="no-siteapp" />

	<link rel="icon" type="image/png" href="<?php echo $img_path;?>favicon.png">

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="<?php echo $img_path;?>app.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Mzsj" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo $img_path;?>app.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="<?php echo $img_path;?>app.png">
	<meta name="msapplication-TileColor" content="#0e90d2">
	<!--[if lt IE 9]>
	<script src="<?php echo $js_path;?>html5.js"></script>
	<script src="<?php echo $js_path;?>respond.js"></script>
	<![endif]-->
</head>

<body class="body-login">
	<style>
		*{padding: 0;margin: 0;}
		.system-message {border: #ccc solid 1px; width: 500px; margin: 100px auto 0; text-align: center; position: relative;}
		h1 {background-color: #383838; height: 2em; line-height: 2em; font-size: 1.2em; color: #FFF; font-weight: normal;}
		.system-message p {margin:3em 0 5em; font-size: 1.2em;}
		.jump {position: absolute; left: 0; right: 0; bottom: 0; background-color: #eee; color: #888;}
	</style>

	<div class="system-message">
	<h1>跳转信息</h1>
	<p class="msgcontent"><?php echo $msg;?></p>
	<!-- <p class="detail">您走错地方了~回去重来吧</p> -->
	<footer class="jump">
	页面自动 <a id="href" href="<?php echo $url; ?>">跳转</a> 等待时间： <b id="wait">2</b>
	</footer>
	</div>
	<script type="text/javascript">
	(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
	})();
	</script>
</body>
</html>