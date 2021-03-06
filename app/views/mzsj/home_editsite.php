<form action="<?php echo base_url('mzsj/home/editsite/'.$site['siteid']);?>" class="form-box" method="post">
	<input type="hidden" name="siteid" value="<?php echo $site['siteid']; ?>">
	<div class="form-group">
		<label for="sysname" class="item-label">站点名称：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[name]" value="<?php echo $site['name']; ?>" class="input-text"  datatype="s1-16" errormsg="站点名称至少5个字符,最多16个字符！"><?php echo form_error('info[name]');?>
	</div>
	<div class="form-group">
		<label for="siteurl" class="item-label">域名：<span class="color_9"> 必须填写，如http://www.mzsj.com，结尾不加/</span></label>
		<input type="text" name="info[siteurl]" value="<?php echo $site['siteurl']; ?>" class="input-text" datatype="url">
		<?php echo form_error('info[siteurl]');?>
	</div>
	<div class="form-group">
		<label for="sitedir" class="item-label">目录地址：<span class="color_9"> 默认是"/"</span></label>
		<input type="text" name="info[sitedir]" value="<?php echo $site['sitedir']; ?>" class="input-text">
	</div>
	<div class="form-group">
		<label for="sitename" class="item-label">网站标题：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[sitename]" value="<?php echo $site['sitename']; ?>" class="input-text" datatype="*2-30">
		<?php echo form_error('info[sitename]');?>
	</div>
	<div class="form-group">
		<label for="keyword" class="item-label">关键字：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[keyword]" value="<?php echo $site['keyword']; ?>" class="input-text" datatype="*1-50">
		<?php echo form_error('info[keyword]');?>
	</div>
	<div class="form-group">
		<label for="description" class="item-label">描述：<span class="color_9"> 必须填写</span></label>
		<textarea name="info[description]" cols="80" rows="4" datatype="*1-200"><?php echo $site['description']; ?></textarea>
		<?php echo form_error('info[description]');?>
	</div>
	<div class="form-group">
		<label for="linkman" class="item-label">联系人：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[linkman]" value="<?php echo $site['linkman']; ?>" class="input-text" datatype="*1-10">
		<?php echo form_error('info[linkman]');?>
	</div>
	<div class="form-group">
		<label for="tel" class="item-label">电话：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[tel]" value="<?php echo $site['tel']; ?>" class="input-text" datatype="m">
		<?php echo form_error('info[tel]');?>
	</div>
	<div class="form-group">
		<label for="qq" class="item-label">Q Q：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[qq]" value="<?php echo $site['qq']; ?>" class="input-text" datatype="n">
		<?php echo form_error('info[qq]');?>
	</div>
	<div class="form-group">
		<label for="address" class="item-label">地址：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[address]" value="<?php echo $site['address']; ?>" class="input-text" datatype="*1-50">
		<?php echo form_error('info[address]');?>
	</div>
	<div class="form-group">
		<label for="contact" class="item-label">联系方式：<span class="color_9"> 必须填写</span></label>
		<textarea name="info[contact]" cols="80" rows="4" datatype="*1-200"><?php echo $site['contact']; ?></textarea>
		<?php echo form_error('info[contact]');?>
	</div>
	<div class="form-group">
		<label for="template" class="item-label">默认模板：<span class="color_9"> 必须填写</span></label>
		<input type="text" name="info[template]" value="<?php echo $site['template'];?>" class="input-text" datatype="*1-50">
		<?php echo form_error('info[template]');?>
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