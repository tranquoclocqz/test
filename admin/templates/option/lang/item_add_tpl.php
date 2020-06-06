<?php 

	$lang_value = json_decode($item['value'],true);


?>
<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script>
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=option&act=save_lang&type=<?php echo $_GET['type'] ?>" method="post" enctype="multipart/form-data">
		<div class="widget">

				<div class="formRow">
					<label>Tiêu đề</label>
					<div class="formRight">
						<input type="text" name="ten" id="ten" class="tipS" value="<?=@$item['ten']?>"  />
					</div>
					<div class="clear"></div>
				</div>
<?php if( $config['edit'] ) { ?>
				<div class="formRow">
					<label>Name</label>
					<div class="formRight">
						<input type="text" name="name" id="name" class="tipS" value="<?=@$item['name']?>"  />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow">
					<label><?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="value[<?php echo $value['slug'] ?>]" title="Nhập <?php echo $value['ten'] ?>" id="value_<?php echo $value['slug'] ?>" class="tipS" value="<?php echo $lang_value[$value['slug']] ?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach ?>
		</div>  
		<div class="widget">
			<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
				<h6></h6>
			</div>
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
					<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=option&act=man_lang<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>

				</div>
				<div class="clear"></div>
			</div>
		</div>
	</form>        
</div>
