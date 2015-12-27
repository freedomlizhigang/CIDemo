<table class="table-form">
	<tr class="tr-header">
		<th width="40">ID</th>
		<th width="80">用户ID</th>
		<th width="80">用户名</th>
		<th width="400">URL</th>
		<th width="150">DATA</th>
		<th width="150">IP</th>
		<th width="170">时间</th>
	</tr>
	<?php foreach ($loglist as $log):?>
	<tr>
		<td><?php echo $log['logid']?></td>
		<td><?php echo $log['adminid']?></td>
		<td><?php echo $log['adminname']?></td>
		<td><?php echo $log['url']?></td>
		<td><?php echo $log['data']?></td>
		<td><?php echo $log['ip']?></td>
		<td><?php echo date('Y-m-d H:i:s',$log['time']);?></td>
	</tr>
	<?php endforeach;?>
	<tr class="tr-btn">
		<td colspan="7"><div class="pages"><?php echo $pages;?></div></td>
	</tr>
</table>
