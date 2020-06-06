<script type="text/javascript">		
	function TreeFilterChanged2(){
		
		$('#validate').submit();
	}
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'photo';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});
	});
</script>
<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=diachi&act=man"><span>Địa chỉ</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=diachi&act=save&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Nhập dữ liệu</h6>
			</div>	
			<?php
			if(true){
				?>
				<div class="formRow">
					<label>Ảnh đại diện :</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<?php if (!$config_auto) { ?>
							<div class="note"> width : 373px , Height : 265px </div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">
							<div class="mt10" style="max-width: 300px;"><img class="max-width" src="<?php echo _upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } 
			}?> 	
			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tên <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên chi nhánh" id="ten_<?php echo $value['slug'] ?>" class="tipS " value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Địa chỉ <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="diachi_<?php echo $value['slug'] ?>" title="Nhập địa chỉ" id="diachi_<?php echo $value['slug'] ?>" class="tipS " value="<?=@$item['diachi_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach ?>
			<div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
					<input type="text" name="dienthoai" title="Nhập Điện thoại" id="dienthoai" class="tipS " value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Iframe bản đồ</label>
				<div class="formRight">
					<textarea name="noidung_vi" id="noidung_vi" cols="30" rows="5"><?=@$item['noidung_vi']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<?php if (!empty($item['noidung_vi'])): ?>
				<div class="formRow">
					<div class="map-wrapper">
						<?php echo $item['noidung_vi'] ?>
					</div>
				</div>
			<?php endif ?>
			<!-- bando -->
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">

					<input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>            
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="id" id="id_this_yahoo" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB"  value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>  
	</form>
</div>

<script>
	$(document).ready(function() {
		$('.file_input').filer({
			showThumbs: true,
			templates: {
				box: '<ul class="jFiler-item-list"></ul>',
				item: '<li class="jFiler-item">\
				<div class="jFiler-item-container">\
				<div class="jFiler-item-inner">\
				<div class="jFiler-item-thumb">\
				<div class="jFiler-item-status"></div>\
				<div class="jFiler-item-info">\
				<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
				</div>\
				{{fi-image}}\
				</div>\
				<div class="jFiler-item-assets jFiler-row">\
				<ul class="list-inline pull-left">\
				<li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
				</ul>\
				<ul class="list-inline pull-right">\
				<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
				</ul>\
				</div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
				</div>\
				</div>\
				</li>',
				itemAppend: '<li class="jFiler-item">\
				<div class="jFiler-item-container">\
				<div class="jFiler-item-inner">\
				<div class="jFiler-item-thumb">\
				<div class="jFiler-item-status"></div>\
				<div class="jFiler-item-info">\
				<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
				</div>\
				{{fi-image}}\
				</div>\
				<div class="jFiler-item-assets jFiler-row">\
				<ul class="list-inline pull-left">\
				<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
				</ul>\
				<ul class="list-inline pull-right">\
				<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
				</ul>\
				</div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
				</div>\
				</div>\
				</li>',
				progressBar: '<div class="bar"></div>',
				itemAppendToEnd: true,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-item-list',
					item: '.jFiler-item',
					progressBar: '.bar',
					remove: '.jFiler-item-trash-action',
				}
			},
			addMore: true
		});
		$('.delete_images').click(function(){
			if (confirm('Bạn có muốn xóa hình này ko ? ')) {
				var id = $(this).attr('title');
				var table = 'photo';
				var links = "../upload/hinhanh/";
				$.ajax ({
					type: "POST",
					url: "ajax/delete_images.php",
					data: {id:id,table:table,links:links},
					success: function(result) { 
					}
				});
				$(this).parents('.item_trich').slideUp();
			}
			return false;
		});
	});
</script>
