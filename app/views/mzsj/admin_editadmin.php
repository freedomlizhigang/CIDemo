<form action="<?php echo base_url('mzsj/admin/editadmin/'.$info['adminid']);?>" class="form-box" method="post">
        <input type="hidden" name="adminid" value="<?php echo $info['adminid']?>" />
        <div class="form-group">
                <label for="roleid" class="item-label">用户组：<span class="color_9"> 必须填写</span></label>
                <select name="info[roleid]" id="" datatype="*">
                        <option value="">请选择用户组</option>
                        <?php foreach ($rolelist as $v) :?>
                        <option value="<?php echo $v['roleid'];?>"<?php if($v['roleid'] == $info['roleid']):?> selected="selected"<?php endif;?>><?php echo $v['rolename'];?></option>
                        <?php endforeach;?>
                </select>
                <?php echo form_error('info[roleid]');?>
        </div>
        <div class="form-group">
                <label for="adminname" class="item-label">用户名：</label>
                <?php echo $info['adminname']?>
        </div>
        <div class="form-group">
                <label for="info[realname]" class="item-label">真实姓名：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[realname]" value="<?php echo $info['realname']?>" class="input-text" datatype="*1-10">
                <?php echo form_error('info[realname]');?>
        </div>
        <div class="form-group">
                <label for="info[email]" class="item-label">邮箱：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[email]" value="<?php echo $info['email']?>" class="input-text" datatype="e">
                <?php echo form_error('info[email]');?>
        </div>
        <div class="form-group">
                <label for="info[tel]" class="item-label">电话：<span class="color_9"> 必须填写</span></label>
                 <input type="text" name="info[tel]" value="<?php echo $info['tel']?>" class="input-text" datatype="n7-11">
                <?php echo form_error('info[tel]');?>
        </div>
        <div class="form-group">
                <label for="status" class="item-label">状态：</label>
                <input type="radio" name="info[status]"<?php if($info['status'] == 1):?> checked="checked"<?php endif;?> class="input-radio" value="1"> 启用
                <input type="radio" name="info[status]"<?php if($info['status'] == 0):?> checked="checked"<?php endif;?> class="input-radio" value="0"> 禁用
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


