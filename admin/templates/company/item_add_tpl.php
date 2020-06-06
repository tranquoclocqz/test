
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

<form name="supplier" id="validate" class="form" action="index.php?com=company&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=company&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<div class="widget">
		<div class="title chonngonngu">
			<ul>
				<?php foreach ($ar_lang as $key => $value): ?>
					<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>	
		<?php if($config_images){ ?>
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
					<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Hình Hiện Tại :</label>
				<div class="formRight">

					<div class="mt10"><img style="max-width: 100%;" src="../thumb/<?php echo _width_thumb ?>x<?php echo _height_thumb ?>/<?php echo _style_thumb ?>/<?=_upload_hinhanh_l.$item['photo']?>"  alt="NO PHOTO"/></div>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<?php foreach ($ar_lang as $key => $value): ?>
		<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
			<label>Nội Dung <?php echo $value['ten'] ?></label>
			<div class="ck_editor">
				<textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach ?>

		<div class="formRow">
			<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
			<div class="clear"></div>
		</div>
	</form>   