<table class="table-form">
	<tr class="tr-header">
		<th width="50">ID</th>
		<th width="80">用户名</th>
		<th width="80">姓名</th>
		<th width="80">角色</th>
		<th width="120">电话</th>
		<th width="160">最后登陆IP</th>
		<th width="200">最后登陆时间</th>
		<th width="100">状态</th>
		<th>操作</th>
	</tr>
	<?php foreach ($adminlist as $a):?>
	<tr>
		<td><?php echo $a['adminid'];?></td>
		<td><?php echo $a['adminname'];?></td>
		<td><?php echo $a['realname'];?></td>
		<td><?php echo $rolename[$a['roleid']]['rolename'];?></td>
		<td><?php echo $a['tel'];?></td>
		<td><?php echo $a['lastip'];?></td>
		<td><?php echo $a['lasttime'];?></td>
		<td><?php echo $a['status'];?></td>
		<td><a href="<?php echo base_url('mzsj/admin/editadmin/'.$a['adminid']);?>">修改</a><?php if($a['adminid'] != 1) :?> | <a href="<?php echo base_url('mzsj/admin/deladmin/'.$a['adminid']);?>">删除</a><?php endif;?></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td colspan="9"><div class="pages"><?php echo $pages;?></div></td>
	</tr>
</table>
