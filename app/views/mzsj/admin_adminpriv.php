<form action="<?php echo base_url('mzsj/admin/adminpriv/'.$roleid);?>" method="post">
<div class="allmenu clearfix">
<input type="hidden" name="roleid" value="<?php echo $roleid?>">
        <?php foreach($tree as $m) :?>
                <?php if($m['level'] == 1):?>
                <h3 class="priv_h3"><input type="checkbox" name="urls[]" class="priv" value="<?php echo $m['url'];?>"><?php echo $m['name'];?></h3>
                <?php endif;?>
                <?php if($m['level'] == 2):?>
                <h4 class="priv_h4"><input type="checkbox" name="urls[]" class="priv" value="<?php echo $m['url'];?>"><?php echo $m['name'];?></h4>
                <?php endif;?>
                <?php if($m['level'] == 3):?>
                <h4 class="priv_h4_2"><input type="checkbox" name="urls[]" class="priv" value="<?php echo $m['url'];?>"><?php echo $m['name'];?></h4>
                <?php endif;?>
                <?php if($m['level'] == 4):?>
                <span><input type="checkbox" name="urls[]" class="priv" value="<?php echo $m['url'];?>"><?php echo $m['name'];?></span>
                <?php endif;?>
        	<?php endforeach;?>
</div>
<div class="priv_btn">
<input type="submit" name="dosubmit" value="授权" class="btn-del" />
</div>
</form>
 <script>
	$(function(){
		var urlArr = [<?php echo $roleurl;?>];
			$(".priv").each(function(s){
		        var thisVal = $(this).val();
		        $.each(urlArr,function(i){
		                if(urlArr[i] == thisVal){
		                        $(".priv").eq(s).attr("checked","true");
		                }
		        });
		});
	});
</script>