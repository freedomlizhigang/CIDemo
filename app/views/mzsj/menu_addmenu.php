<form action="" class="form-box" method="post">
	<input type="hidden" name="info[parentid]" value="<?php echo $pid; ?>">
	<div class="form-group">
		<label for="name" class="item-label">菜单名称： <span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[name]" class="input-text" datatype="s1-16" errormsg="菜单名称至少5个字符,最多16个字符！">
		<?php echo form_error('info[name]');?>
	</div>
	<div class="form-group">
		<label for="url" class="item-label">URL： <span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[url]" class="input-text" datatype="*1-30" errormsg="URL必须填写！">
		<?php echo form_error('info[url]');?>
	</div>
	<div class="form-group">
		<label for="listorder" class="item-label">排序：</label>
		<input type="text" name="info[listorder]" value="0" class="input-sm input-text">
		<?php echo form_error('info[listorder]');?>
	</div>
	<div class="form-group">
		<label for="display" class="item-label">是否显示：</label>
		<input type="radio" name="info[display]" checked="checked" class="input-radio" value="1"> 是
		<input type="radio" name="info[display]" class="input-radio" value="0"> 否
	</div>
	<div class="form-group">
		<button type="submit" name="dosubmit" class="btn-success">提交</button><button type="reset" name="reset" class="btn-error">重填</button>
	</div>
</form>
<script>
	$(function(){
		$(".form-box").Validform({
			tiptype:3, //在侧边弹出提示信息
		});
	});
</script>