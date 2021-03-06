<form action="<?php echo base_url('mzsj/admin/addadmin/');?>" class="form-box" method="post">
        <div class="form-group">
                <label for="roleid" class="item-label">用户组：<span class="color_9"> 必须填写</span></label>
                <select name="info[roleid]" id="" datatype="*">
                        <option value="">请选择用户组</option>
                        <?php foreach ($rolelist as $v) :?>
                        <option value="<?php echo $v['roleid'];?>"><?php echo $v['rolename'];?></option>
                        <?php endforeach;?>
                </select>
                <?php echo form_error('info[roleid]');?>
        </div>
        <input type="hidden" name="info[encrypt]" class="input-text" value="<?php echo $encrypt;?>">
        <div class="form-group">
                <label for="adminname" class="item-label">用户名：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[adminname]" class="input-text"  datatype="*1-10">
                <?php echo form_error('info[adminname]');?>
        </div>
        <div class="form-group">
                <label for="info[realname]" class="item-label">真实姓名：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[realname]" class="input-text" datatype="*1-10">
                <?php echo form_error('info[realname]');?>
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
                <label for="info[email]" class="item-label">邮箱：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[email]" class="input-text" datatype="e">
                <?php echo form_error('info[email]');?>
        </div>
        <div class="form-group">
                <label for="info[tel]" class="item-label">电话：<span class="color_9"> 必须填写</span></label>
                 <input type="text" name="info[tel]" class="input-text" datatype="n7-11">
                <?php echo form_error('info[tel]');?>
        </div>
        <div class="form-group">
                <label for="status" class="item-label">状态：</label>
                <input type="radio" name="info[status]" checked="checked" class="input-radio" value="1"> 启用
                <input type="radio" name="info[status]" class="input-radio" value="0"> 禁用
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


