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

	<form name="supplier" id="validate" class="form" action="index.php?com=option&act=save&type=<?php echo $_GET['type'] ?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
				<div class="formRow">
					<label>Tiêu đề</label>
					<div class="formRight">
						<input type="text" name="ten" title="Nhập tiêu đề <?php echo $value['ten'] ?>" id="ten" class="tipS validate[required]" value="<?=@$item['ten']?>" />
					</div>
					<div class="clear"></div>
				</div>
				<?php if ($config_mota): ?>
				<div class="formRow">
					<label>Nội dung</label>
					<div class="ck_editor">
						<textarea name="value" id="value" cols="30" rows="10"><?=@$item['value']?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<?php endif ?>
				<?php if(false){?>
				<div class="formRow">
					<label>Tải hình ảnh: </label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					</div>
					<div class="clear"></div>
				</div>

				<?php if($_GET['act']=='edit' && !empty($item['photo'])){?>
					<div class="formRow">
						<label> Ảnh hiện tại:</label>
						<div class="formRight">	
							<div class="mt10"><img src=".<?=_upload_hinhanh.$item['photo']?>" style="background: #ccc;"  alt="NO PHOTO" class="max-width" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } } ?>				
			<div class="formRow">
				<label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
				<div class="formRight">
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label>Số thứ tự: </label>
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
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
					<a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>

				</div>
				<div class="clear"></div>
			</div>
		</div>
	</form>        
</div>
