<form action="/mzsj/menu/delmenu" method="post">
<table class="table-form">
	<tr class="tr-header">
		<th width="1"><input type="checkbox" value="" class="checkall"></th>
		<th width="50">ID</th>
		<th width="60">排序</th>
		<th>菜单名称</th>
		<th>URL</th>
		<th>是否显示</th>
		<th>操作</th>
	</tr>
	<?php foreach ($tree as $k => $v) : ?>
	<tr>
		<td><input type="checkbox" name="mids[]" value="<?php echo $v['menuid'];?>" class="subcheck"></td>
		<td><?php echo $v['menuid'];?></td>
		<td><?php echo $v['listorder'];?></td>
		<td><span class="f_l"><?php echo $v['nbsp'].$v['name'];?></span>
			<?php if($v['level'] < 4):?><a href="/mzsj/menu/addmenu/<?php echo $v['menuid'];?>" class='addsub'></a><?php endif;?>
		</td>
		<td><?php echo $v['url'];?></td>
		<td><?php echo $v['displayname'];?></td>
		<td><a href="/mzsj/menu/editmenu/<?php echo $v['menuid'];?>">修改</a> | <a href="/mzsj/menu/delmenu/<?php echo $v['menuid'];?>" class="confirm">删除</a></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td><input type="checkbox" value="" class="checkall"></td>
		<td colspan="6"><input type="submit" value="删除" name="dosubmit" class="btn-del confirm" /></td>
	</tr>
</table>
</form>
