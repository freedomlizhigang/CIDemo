<form action="/mzsj/content/delcate" method="post">
<table class="table-form">
	<tr class="tr-header">
		<th width="1"><input type="checkbox" value="" class="checkall"></th>
		<th width="50">ID</th>
		<th width="60">排序</th>
		<th>栏目名称</th>
		<th>栏目目录</th>
		<th>是否显示</th>
		<th>单网页</th>
		<th>外链接</th>
		<th>操作</th>
	</tr>
	<?php foreach ($tree as $k => $v) : ?>
	<tr>
		<td><input type="checkbox" name="cids[]" value="<?php echo $v['catid'];?>" class="subcheck"></td>
		<td><?php echo $v['catid'];?></td>
		<td><?php echo $v['listorder'];?></td>
		<td><span class="f_l"><?php echo $v['nbsp'].$v['catname'];?></span>
			<a href="/mzsj/content/addcate/<?php echo $v['catid'];?>" class='addsub'></a>
		</td>
		<td><?php echo $v['catdir'];?></td>
		<td><?php echo $v['displayname'];?></td>
		<td><?php echo $v['ispage'];?></td>
		<td><?php echo $v['islink'];?></td>
		<td><a href="/mzsj/content/editcate/<?php echo $v['catid'];?>">修改</a> | <a href="/mzsj/content/delcate/<?php echo $v['catid'];?>" class="confirm">删除</a></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td><input type="checkbox" value="" class="checkall"></td>
		<td colspan="10"><input type="submit" value="删除" name="dosubmit" class="btn-del confirm" /></td>
	</tr>
</table>
</form>
