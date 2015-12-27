<form action="<?php echo base_url('mzsj/admin/editrole/'.$info['roleid']);?>" class="form-box" method="post">
        <input type="hidden" name="roleid" value="<?php echo $info['roleid']; ?>">
        <div class="form-group">
                <label for="rolename" class="item-label">角色名称：<span class="color_9"> 必须填写</span></label>
                <input type="text" name="info[rolename]" value="<?php echo $info['rolename']; ?>" class="input-text"  datatype="*1-16">
                <?php echo form_error('info[rolename]');?>
        </div>
        <div class="form-group">
                <label for="status" class="item-label">状态：</label>
                <input type="radio" name="info[status]"<?php if($info['status'] == 1 ): ?> checked="checked"<?php endif;?> class="input-radio" value="1"> 启用
                <input type="radio" name="info[status]"<?php if($info['status'] == 0 ): ?> checked="checked"<?php endif;?> class="input-radio" value="0"> 禁用
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