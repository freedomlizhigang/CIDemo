<style>
	*{padding: 0;margin: 0;}
	.system-message {border: #ccc solid 1px; width: 500px; margin: 100px auto 0; text-align: center; position: relative;}
	h1 {background-color: #383838; height: 2em; line-height: 2em; font-size: 1.2em; color: #FFF; font-weight: normal;}
	.system-message p {margin:3em 0 5em; font-size: 1.2em;}
	.jump {position: absolute; left: 0; right: 0; bottom: 0; background-color: #eee; color: #888;}
</style>

<div class="system-message">
<h1>跳转信息</h1>
<p class="msgcontent"><?php echo $content; ?></p>
<!-- <p class="detail">您走错地方了~回去重来吧</p> -->
<footer class="jump">
<?php if(empty($url)){ ?>
<a href="javascript:history.back();" >返回上一页</a>
<?php } else {?>
页面自动 <a id="href" href="<?php echo $url; ?>">跳转</a> 等待时间： <b id="wait">2</b>
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
<?php }?>
</footer>
</div>