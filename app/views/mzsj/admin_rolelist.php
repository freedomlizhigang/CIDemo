<table class="table-form">
	<tr class="tr-header">
		<th width="40">ID</th>
		<th width="200">角色名</th>
		<th width="100">状态</th>
		<th>操作</th>
	</tr>
	<?php foreach ($rolelist as $role):?>
	<tr>
		<td><?php echo $role['roleid']?></td>
		<td><?php echo $role['rolename']?></td>
		<td><?php echo $role['statusname']?></td>
		<td><a href="<?php echo base_url('mzsj/admin/editrole/'.$role['roleid']);?>">修改</a><?php if($role['roleid'] != 1) :?> | <a href="<?php echo base_url('mzsj/admin/delrole/'.$role['roleid']);?>">删除</a> | <a href="<?php echo base_url('mzsj/admin/adminpriv/'.$role['roleid']);?>">修改权限</a><?php endif;?></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
	</tr>
</table>
