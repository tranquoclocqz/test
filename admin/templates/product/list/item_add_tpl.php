
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
		$('.delete_images').click(function(){
			if (confirm('Bạn có muốn xóa hình này ko ? ')) {
				var id = $(this).attr('title');
				var table = 'product_photo';
				var links = "../upload/product/";
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
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm Danh mục cấp 1</span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">

			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<?php
			if($config_images){
				?>
				<div class="formRow">
					<label>Ảnh đại diện :</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<?php if (!$config_auto) { ?>
							<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit_list'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">
							<?php if ($config_auto) { ?>
								<div class="mt10" style="max-width: 300px;"><img class="max-width" src="<?php echo _upload_product.$item['photo']?>"  alt="NO PHOTO" /></div>
							<?php } else { ?>
								<div class="mt10" style="max-width: 300px;"><img class="max-width" src="../thumb/<?php echo _width_thumb.'x'._height_thumb.'/2/'._upload_product_l.$item['photo']?>"  alt="NO PHOTO" /></div>
							<?php } ?>
							

						</div>
						<div class="clear"></div>
					</div>
				<?php } 
			}?> 
			<?php if ($config_color): ?>
				<div class="formRow">
					<label>Màu sắc</label>
					<div class="formRight">
						<input type="text" class="color" name="color" title="Nhập màu" class="tipS validate[required]" value="<?=@$item['color']?>" size="15" />
					</div>
					<div class="clear"></div>
				</div>				
			<?php endif ?>
			<?php
			if($config_quangcao){
				?>
				<div class="formRow">
					<label>Ảnh 2:</label>
					<div class="formRight">
						<input type="file" id="file" name="quangcao" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<div class="note"> width : <?php echo _width_thumb_2*$ratio_;?> px , Height : <?php echo _height_thumb_2*$ratio_;?> px </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit_list'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10" style="max-width: 300px;"><img class="max-widht" src="<?php echo _upload_product.$item['quangcao']?>"  alt="NO PHOTO" /></div>

						</div>
						<div class="clear"></div>
					</div>
				<?php } ?> 
			<?php } ?>
			<?php if ($config_quangcao2): ?>
				<div class="formRow">
					<label>Hình ảnh đại diện:</label>
					<div class="formRight">
						<input type="file" id="file" name="quangcao_2" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<div class="note"> width : <?php echo _width_thumb_3*$ratio_;?> px , Height : <?php echo _height_thumb_3*$ratio_;?> px </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit_list'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10"><img class="max-widht" src="../thumb/<?php echo _width_thumb_3.'x'._height_thumb_3.'/1/'._upload_product_l.$item['quangcao_2']?>"  alt="NO PHOTO" /></div>

						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php endif ?>
			<?php if ($config_quangcao3): ?>
				<div class="formRow">
					<label>Hình ảnh quảng cáo 2</label>
					<div class="formRight">
						<input type="file" id="file" name="quangcao_3" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<div class="note"> width : <?php echo _width_thumb_4*$ratio_;?> px , Height : <?php echo _height_thumb_4*$ratio_;?> px </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit_list'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10"><img class="max-widht" src="../thumb/<?php echo _width_thumb_4.'x'._height_thumb_4.'/1/'._upload_product_l.$item['quangcao_3']?>"  alt="NO PHOTO" /></div>

						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php endif ?>

			<?php if($config_mul){ ?>
				<div class="formRow">
					<label>Hình ảnh kèm theo: </label>
					<div class="formRight">
						<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="images/image_add.png" alt="" width="100"></a>
						<div class="clear"></div>
						<div class="note"> width : <?php echo 380;?> px , Height : <?php echo 280;?> px </div>
						<div class="clear"></div>
						<?php if($act=='edit_list' && count($ds_photo)!=0){?>
							<div class="clear_gal">       
								<?php for($i=0;$i<count($ds_photo);$i++){?>
									<div class="item_trich">
										<div class="border-box">
											<div>
												<img class="img_trich" src="../thumb/148x135/2/<?=_upload_product_l.$ds_photo[$i]['photo']?>" />
												<a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?=$ds_photo[$i]['id']?>" style="color:#FF0000"></a>
												<input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php }?>
					</div>
					<div class="clear"></div>
				</div> 
			<?php } ?>	

			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề <br> <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach ?>
			<?php include _template."handle_slug.php" ?>
			<?php foreach ($ar_lang as $key => $value): ?>
				<?php if ($config_title): ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Title <br> <?php echo $value['ten'] ?></label>
						<div class="formRight">
							<input type="text" name="name_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="name_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['name_'.$value['slug']]?>" />
						</div>
						<div class="clear"></div>
					</div>
				<?php endif ?>
				<?php if($config_mota){ ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Mô tả <br> <?php echo $value['ten'] ?> </label>
						<div class="formRight">
							<textarea rows="4" cols="" title="Nhập mô tả <?php echo $value['ten'] ?> " class="tipS" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
				<?php if ($config_noidung): ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Nội dung <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php endif ?>
				<?php if ($config_noidung2): ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Nội dung dưới <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="noidung2_<?php echo $value['slug'] ?>" name="noidung2_<?php echo $value['slug'] ?>"><?=@$item['noidung2_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php endif ?>		
			<?php endforeach ?>
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
				<h6>Nội dung seo</h6>
			</div>

			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<?php foreach ($ar_lang as $key => $value){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Title <br> <?php echo $value['ten'] ?></label>
					<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<input type="text" value="<?=@$item['title_'.$value['slug']]?>" name="title_<?php echo $value['slug'] ?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Từ khóa <br> <?php echo $value['ten'] ?></label>
					<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<input type="text" value="<?=@$item['keywords_'.$value['slug']]?>" name="keywords_<?php echo $value['slug'] ?>" title="Từ khóa chính cho danh mục" class="tipS" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Description <br> <?php echo $value['ten'] ?></label>
					<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<textarea rows="4" class="description" cols="<?php echo $value['slug']?>" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description_<?php echo $value['slug'] ?>"><?=@$item['description_'.$value['slug']]?></textarea>
						<input readonly="readonly" type="text" name="des_char" class="des_char_<?php echo $value['slug']?>" value="<?=@$item['des_char_'.$value['slug']]?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>

			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>

				</div>
				<div class="clear"></div>
			</div>
		</div>
	</form>        </div>

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
		});
	</script>
