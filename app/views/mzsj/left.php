<?php foreach ($two_menu as $v):?>
	<h3 class="left_h3"> <i class="icon"></i><?php echo $v['name']?></h3>
	<ul class="left_list">
		<?php $sub_array = $mzsj->findmenu($v['menuid']);
		foreach($sub_array as $sub) {?>
		<li class="sub_menu" id="left_menu<?php echo $sub['menuid'];?>"><a href="javascript:_LM(<?php echo $sub['menuid'];?>,'<?php echo '/'.$sub['url']?>')" class="sub_menu"><?php echo $sub['name']?></a></li>
		<?php }?>
	</ul>
<?php endforeach;?>