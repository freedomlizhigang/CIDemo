<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
	<script src="<?php echo $js_path;?>jquery.js"></script>
	<script src="<?php echo $js_path;?>mzsj/common.js"></script>
	<script src="<?php echo $js_path;?>Validform.min.js"></script>
	<script src="<?php echo $js_path;?>kindeditor/kindeditor-all-min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $css_path;?>mzsj/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $css_path;?>validform.css" />
	<style type="text/css">
	html {font-size: 14px;}
	</style>
</head>

<body>
	<!-- 右侧标题 -->
	<div class="clearfix">
		<h2 class="main_title f_l"><?php echo $title;?></h2>
		<div class="btn-group f_l">
		<?php foreach ($rightmenu as $rmenu):?>
			<a href="<?php echo '/'.$rmenu['url']?>" class="btn-green">[ <?php echo $rmenu['name']?> ]</a>
		<?php endforeach;?>
		</div>
	</div>
	<div class="right_con">