<form action="<?php echo base_url('mzsj/content/addcate/');?>" class="form-box" method="post" enctype="multipart/form-data">
        <input type="hidden" name="info[parentid]" value="<?php echo $pid;?>">
        <div class="form-group">
                <label for="catname" class="item-label">栏目名称：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[catname]" class="input-text"  datatype="*2-15">
                <?php echo form_error('info[catname]');?>
        </div>
        <div class="form-group">
                <label for="info[catdir]" class="item-label">栏目目录：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[catdir]" class="input-text" datatype="*2-15">
                <?php echo form_error('info[catdir]');?>
        </div>
        <div class="form-group">
                <label for="info[keyword]" class="item-label">栏目关键字：</label>
                <input type="text" name="info[keyword]" class="input-text">
        </div>
        <div class="form-group">
                <label for="description" class="item-label">描述：</label>
                <textarea name="info[description]" cols="60" rows="4" class="input-textarea"></textarea>
        </div>
        <div class="form-group">
                <label for="info[image]" class="item-label">栏目图片：</label>
                <div class="clearfix">
                    <input type="text" name="info[image]" id="url3" value="" class="input-text f_l">
                    <input type="button" class="btn-upload f_l ml10" id="image3" value="选择图片" />
                </div>
        </div>
        <div class="form-group">
            <label for="info[content]" class="item-label">内容：<span class="color_9"> 必须填写</span></label>
            <textarea name="info[content]" id="content_edit" style="width:96%" rows="20"></textarea>
            <?php echo form_error('info[content]');?>
        </div>
        <div class="form-group">
            <label for="info[listorder]" class="item-label">排序：</label>
            <input type="text" name="info[listorder]" value="0" class="input-sm">
        </div>
        <div class="form-group">
            <label for="ismenu" class="item-label">是否在导航显示：</label>
            <input type="radio" name="ismenu" checked="checked" class="input-radio" value="1"> 显示
            <input type="radio" name="ismenu" class="input-radio" value="0"> 不显示
        </div>
        <div class="form-group">
            <label for="islink" class="item-label">是否外部链接：</label>
            <input type="radio" name="islink" class="input-radio" value="1"> 是
            <input type="radio" name="islink" checked="checked" class="input-radio" value="0"> 否
        </div>
        <div class="form-group">
            <label for="info[url]" class="item-label">外链接地址：</label>
            <input type="text" name="info[url]" class="input-text" datatype="*0-0|url">
            <?php form_error('info[url]');?>
        </div>
        <div class="form-group">
            <label for="ispage" class="item-label">是否单网页：</label>
            <input type="radio" name="ispage" class="input-radio" value="1"> 是
            <input type="radio" name="ispage" checked="checked" class="input-radio" value="0"> 否
        </div>
        <div class="form-group">
            <label for="shenhe" class="item-label">文章是否需要审核：</label>
            <input type="radio" name="shenhe" class="input-radio" value="1"> 是
            <input type="radio" name="shenhe" checked="checked" class="input-radio" value="0"> 否
        </div>
        <div class="form-group">
            <label for="info[cattpl]" class="item-label">栏目模板：<span class="color_9"> 如果为单网页，请修改为page</span></label>
            <input type="text" name="info[cattpl]" value="cate" class="input-text">
        </div>
        <div class="form-group">
            <label for="info[arttpl]" class="item-label">文章模板：</label>
            <input type="text" name="info[arttpl]" value="show" class="input-text">
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
    KindEditor.ready(function(K) {
        window.editor = K.create('#content_edit', {
            uploadJson : '<?php echo base_url('mzsj/common/kindupload');?>',
            extraFileUploadParams: {
                session_id : '<?php echo session_id();?>'
            }
        });
        K('#image3').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    showRemote : false,
                    imageUrl : K('#url3').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#url3').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>


