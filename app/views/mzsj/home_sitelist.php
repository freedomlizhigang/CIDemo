<table class="table-form">
	<tr class="tr-header">
		<th width="40">ID</th>
		<th width="150">站点名</th>
		<th width="300">域名</th>
		<th width="150">模板目录</th>
		<th width="150">联系人</th>
		<th width="150">联系电话</th>
		<th>操作</th>
	</tr>
	<?php foreach ($sitelist as $site):?>
	<tr>
		<td><?php echo $site['siteid']?></td>
		<td><?php echo $site['name']?></td>
		<td><?php echo $site['siteurl']?></td>
		<td><?php echo $site['sitedir']?></td>
		<td><?php echo $site['linkman']?></td>
		<td><?php echo $site['tel']?></td>
		<td><a href="<?php echo base_url('mzsj/home/editsite/'.$site['siteid']);?>">修改</a><!--  | <a href="{:U('delsite',array('siteid'=>$site['siteid']))}">删除</a> --></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td colspan="7"><div class="pages"><?php echo $pages;?></div></td>
	</tr>
</table>