<form action="<?php echo base_url('mzsj/content/editcate/'.$info['catid']);?>" class="form-box" method="post" enctype="multipart/form-data">
        <input type="hidden" name="catid" value="<?php echo $info['catid']?>" />
        <div class="form-group">
            <label for="info[parentid]" class="item-label">父栏目：<span class="color_9"> 必须填写</span></label>
            <select name="info[parentid]" id="parentid">
                <option value="">请选择</option>
                <?php foreach ($catetree as $v):?>
                <option value="<?php echo $v['catid'];?>"<?php if($v['catid'] == $info['parentid']):?> selected="selected"<?php endif;?>><?php echo $v['nbsp'].$v['catname'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
                <label for="catname" class="item-label">栏目名称：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[catname]" value="<?php echo $info['catname'];?>" class="input-text"  datatype="*2-15">
                <?php echo form_error('info[catname]');?>
        </div>
        <div class="form-group">
                <label for="info[catdir]" class="item-label">栏目目录：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[catdir]" value="<?php echo $info['catdir'];?>" class="input-text" datatype="*2-15">
                <?php echo form_error('info[catdir]');?>
        </div>
        <div class="form-group">
                <label for="info[keyword]" class="item-label">栏目关键字：</label>
                <input type="text" name="info[keyword]" value="<?php echo $info['keyword'];?>" class="input-text">
        </div>
        <div class="form-group">
                <label for="description" class="item-label">描述：</label>
                <textarea name="info[description]" cols="60" rows="4" class="input-textarea"><?php echo $info['description'];?></textarea>
        </div>
        <div class="form-group">
                <label for="info[image]" class="item-label">栏目图片：</label>
                <div class="clearfix">
                    <input type="text" name="info[image]" id="url3" value="<?php echo $info['image'];?>" class="input-text f_l">
                    <input type="button" class="btn-upload f_l ml10" id="image3" value="选择图片" />
                </div>
        </div>
        <div class="form-group">
            <label for="info[content]" class="item-label">内容：<span class="color_9"> 必须填写</span></label>
            <textarea name="info[content]" id="content_edit" style="width:96%" rows="20"><?php echo $info['content'];?></textarea>
            <?php echo form_error('info[content]');?>
        </div>
        <div class="form-group">
            <label for="info[listorder]" class="item-label">排序：</label>
            <input type="text" name="info[listorder]" value="<?php echo $info['listorder'];?>" class="input-sm">
        </div>
        <div class="form-group">
            <label for="ismenu" class="item-label">是否在导航显示：</label>
            <input type="radio" name="ismenu"<?php if($info['ismenu'] == 1):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['ismenu'];?>"> 显示
            <input type="radio" name="ismenu"<?php if($info['ismenu'] == 0):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['ismenu'];?>"> 不显示
        </div>
        <div class="form-group">
            <label for="islink" class="item-label">是否外部链接：</label>
            <input type="radio" name="islink" class="input-radio"<?php if($info['islink'] == 1):?> checked="checked"<?php endif;?> value="<?php echo $info['islink'];?>"> 是
            <input type="radio" name="islink"<?php if($info['islink'] == 0):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['islink'];?>"> 否
        </div>
        <div class="form-group">
            <label for="info[url]" class="item-label">外链接地址：</label>
            <input type="text" name="info[url]" class="input-text" value="<?php echo $info['url'];?>" datatype="*0-0|url">
            <?php form_error('info[url]');?>
        </div>
        <div class="form-group">
            <label for="ispage" class="item-label">是否单网页：</label>
            <input type="radio" name="ispage"<?php if($info['ispage'] == 1):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['ispage'];?>"> 是
            <input type="radio" name="ispage"<?php if($info['ispage'] == 0):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['ispage'];?>"> 否
        </div>
        <div class="form-group">
            <label for="shenhe" class="item-label">文章是否需要审核：</label>
            <input type="radio" name="shenhe"<?php if($info['shenhe'] == 1):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['shenhe'];?>"> 是
            <input type="radio" name="shenhe"<?php if($info['shenhe'] == 0):?> checked="checked"<?php endif;?> class="input-radio" value="<?php echo $info['shenhe'];?>"> 否
        </div>
        <div class="form-group">
            <label for="info[cattpl]" class="item-label">栏目模板：<span class="color_9"> 如果为单网页，请修改为page</span></label>
            <input type="text" name="info[cattpl]" value="<?php echo $info['cattpl'];?>" class="input-text">
        </div>
        <div class="form-group">
            <label for="info[arttpl]" class="item-label">文章模板：</label>
            <input type="text" name="info[arttpl]" value="<?php echo $info['arttpl'];?>" class="input-text">
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


