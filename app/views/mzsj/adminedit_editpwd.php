<form action="<?php echo base_url('mzsj/adminedit/editpassword/'.$info['adminid']);?>" class="form-box" method="post">
        <input type="hidden" name="adminid" value="<?php echo $info['adminid']?>" />
        <div class="form-group">
                <label for="adminname" class="item-label">用户名：</label>
                <?php echo $info['adminname']?>
        </div>
        <div class="form-group">
                <label for="oldpassword" class="item-label">旧密码：<span class="color_9"> 必须填写</span></label>
                <input type="password" name="oldpassword" class="input-text" datatype="*6-15">
                <?php echo form_error('oldpassword');?>
        </div>
        <div class="form-group">
                <label for="info[password]" class="item-label">密码：<span class="color_9"> 必须填写</span></label>
                <input type="password" name="info[password]" class="input-text" datatype="*6-15">
                <?php echo form_error('info[password]');?>
        </div>
        <div class="form-group">
                <label for="repassword" class="item-label">确认密码：<span class="color_9"> 必须填写</span></label>
                <input type="password" name="repassword" class="input-text" recheck="info[password]" datatype="*6-15">
                <?php echo form_error('repassword');?>
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


