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
	<link rel="stylesheet" type="text/css" href="<?php echo $css_path;?>mzsj/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $css_path;?>validform.css" />
</head>

<body class="body-login">
	<div class="box-login">
	<h1 class="h1-login h_img"><img src="<?php echo $img_path;?>index/logo.png" width="240" height="46" alt="木子设计管理中心"></h1>
	<div class="form_group">
		<form action="<?php echo base_url('mzsj/common/login/');?>" method="post" class="form-box">
			<div class="form-group">
				<label for="username" class="item-label">用户名：</label>
				<input type="text" value="" name="username" class="input-text" datatype="*1-10" errormsg="用户名最多10字符！" nullmsg="请输入用户名！">
				<?php echo form_error('username');?>
			</div>
			<div class="form-group">
				<label for="password" class="item-label">密码：</label>
				<input type="password" value="" name="password" class="input-text" datatype="*6-15" errormsg="密码必须是6到15位字符！" nullmsg="请输入密码！">
				<?php echo form_error('password');?>
			</div>
			<div class="form-group clearfix">
				<label for="rolename" class="item-label">验证码：</label>
				<input type="text" value="" name="verify" class="input-text f_l" style="width:100px; margin-right:10px;" nullmsg="请输入验证码！">
				<a title="点击刷新" class="verifyclick f_l h_img"></a>
				<script>
				$(function(){
					$('.verifyclick').load('<?php echo site_url('mzsj/common/verify');?>').click(function(){
						$('.verifyclick').load('<?php echo site_url('mzsj/common/verify');?>');
					});
	                $(".form-box").Validform({
	                        tiptype:1, //在侧边弹出提示信息
	                });
				});
				</script>
			</div>
			<div class="form-group">
				<button type="submit" name="dosubmit" class="btn-success">提交</button><button type="reset" name="reset" class="btn-error">重填</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>