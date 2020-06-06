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
				var table = 'baiviet_photo';
				var links = "../upload/baiviet/";
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
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'baiviet_photo';
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

<form name="supplier" id="validate" class="form" action="index.php?com=info&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=info&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
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

		<?php if($file_baogia){ ?>
			<div class="formRow">
				<label>Tải file báo giá:</label>
				<div class="formRight">
					<input type="file" id="file" name="file_baogia" />
					<img src="./images/question-button.png" alt="Upload file" class="icon_question tipS" original-title="Tải file báo giá PDF">
				</div>
				<div class="clear"></div>
			</div>
			<?php if( !empty($item['file_baogia']) ) { ?>
				<div class="formRow">
					<label>File Hiện Tại :</label>
					<div class="formRight">
						<object width="600" height="400" data="<?php echo _upload_files.$item['file_baogia'] ?>"></object>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
		<?php } ?>

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

					<div class="mt10"><img style="max-width: 100%;" src="../thumb/<?php echo _width_thumb ?>x<?php echo _height_thumb ?>/<?php echo _style_thumb ?>/<?=_upload_hinhanh_l.$item['thumb']?>"  alt="NO PHOTO"/></div>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

		<?php if($config_mul){ ?>
			<div class="formRow">
				<label>Hình ảnh kèm theo: </label>
				<div class="formRight">
					<input type="file" name="files" class="filer_input" id="filer_input">
					<?php if(count($ds_photo)!=0){?>
						<div class="clear_gal">       
							<?php for($i=0;$i<count($ds_photo);$i++){
								?>
								<div class="item_trich">
									<div class="border-box">
										<div>
											<img class="img_trich" src="../thumb/148x135/2/<?=_upload_baiviet_l.$ds_photo[$i]['photo']?>" />
											<a class="delete_images icon-jfi-trash jFiler-item-trash-action" title="<?=$ds_photo[$i]['id']?>" style="color:#FF0000"></a>
											<input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
										</div>
									</div>									
								</div>
							<?php } ?>
						</div>
					<?php }?>
					<div class="clear"></div>		
				</div>				
				<div class="clear"></div>				
			</div> 
		<?php } ?>
		<?php foreach ($ar_lang as $key => $value): ?>
			<?php if($config_name){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề trên<br/> <?php echo $value['ten']; ?> </label>
					<div class="formRight">
						<input type="text" name="name_<?php echo $value['slug'] ?>" title="Nhập tên" id="name_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['name_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if($config_name2){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề dưới<br/> <?php echo $value['ten']; ?> </label>
					<div class="formRight">
						<input type="text" name="name2_<?php echo $value['slug'] ?>" title="Nhập tên" id="name2_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['name2_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
		<?php endforeach; ?>
		<?php if($config_ten){ ?>
			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề <br/> <?php echo $value['ten']; ?> </label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
			<?php include _template."handle_slug.php" ?>
		<?php } ?>	
		<?php foreach ($ar_lang as $key => $value): ?>		
			<?php if($config_mota){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Mô tả <br/> <?php echo $value['ten']; ?> </label>
					<div <?php if($config_mota_ckeditor){ ?> class="ck_editor" <?php } else { ?> class="formRight" <?php } ?> >
						<textarea id="mota_<?php echo $value['slug'] ?>" rows="5" name="mota_<?php echo $value['slug'] ?>"><?php echo (@$item['mota_'.$value['slug']]) ?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if ($config_option): ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Thông số mô tả </label>
					<div class="formRight">
						<div class="append append_<?php echo $value['slug'] ?>">
							<?php 
							$op2 = json_decode(@$item['options_'.$value['slug']],true);
							?>
							<?php foreach ($op2 as $key => $value2): ?>
								<div class="itemx">
									<div>
										<div class="formRow">
											<label>Tiêu đề</label>
											<div class="formRight"><input type="text" value="<?php echo $value2['title'] ?>" name="title_option_<?php echo $value['slug'] ?>[]" class="tipS"></div>
											<div class="clear"></div>
										</div>
									</div>
									<div>
										<div class="formRow">
											<label>Nội dung</label>
											<div class="formRight"><textarea name="content_option_<?php echo $value['slug'] ?>[]" id="" cols="30" rows="5"><?php echo br2nl($value2['content']) ?></textarea></div>
											<div class="clear"></div>
										</div>
									</div>
									<button type="button" class="btn-custom btn btn-delete btn-danger">Xóa</button>
									<hr>
								</div>
							<?php endforeach ?>
						</div>
						<button type="button" class="btn-add btn-custom btn btn-primary">Thêm mới</button>
					</div>
					<div class="clear"></div>
				</div>
				<script>
					$(function(){
						$(".btn-add").click(function(event) {
							$(".append_<?php echo $value['slug'] ?>").append('<div class="itemx">\
								<div>\
								<div class="formRow">\
								<label>Tiêu đề</label>\
								<div class="formRight"><input type="text" name="title_option_<?php echo $value['slug'] ?>[]" class="tipS"></div>\
								<div class="clear"></div>\
								</div>\
								</div>\
								<div>\
								<div class="formRow">\
								<label>Nội dung</label>\
								<div class="formRight"><textarea name="content_option_<?php echo $value['slug'] ?>[]" id="" cols="30" rows="5"></textarea></div>\
								<div class="clear"></div>\
								</div>\
								</div>\
								<button type="button" class="btn-custom btn btn-danger">Xóa</button>\
								<hr>\
								</div>');
						});
					})
				</script>
			<?php endif ?>
			<?php if($config_noidung){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Nội Dung <br/> <?php echo $value['ten']; ?> </label>
					<div class="ck_editor">
						<textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
					</div>
					<div class="clear"></div>
				</div>

			<?php }?>
		<?php endforeach ?>
		<?php if ($config_hienthi): ?>
			<div class="formRow">
				<label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
				<div class="formRight">

					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
				</div>
				<div class="clear"></div>
			</div>
		<?php endif ?>
		<?php if($config_links){ ?>
			<!-- <div class="formRow">
				<label>Video Hiện Tại :</label>
				<div class="formRight">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo getIDYoutube($item['links']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					

				</div>
				<div class="clear"></div>
			</div> -->
			<div class="formRow lang_hidden lang_en active">
				<label>Link</label>
				<div class="formRight">
					<input type="text" name="links" title="Nhập link" id="links" class="tipS" value="<?=@$item['links']?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>	
	</div>		
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6><?php if ($config_seo): ?>Nội dung seo <?php else: ?> Cập nhật <?php endif ?></h6>
		</div>
		<?php if ($config_seo): ?>
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
		<?php endif ?>
		<?php if ($config_seo): foreach ($ar_lang as $key => $value){ ?>
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
		<?php } endif; ?>

		<div class="formRow">
			<div class="formRight">
				<input type="hidden" name="id_cat" id="id_this_product" value="<?=@$item['id_cat']?>" />
				<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>   
<script>
	$(document).ready(function() {
		$(".btn-delete").click(function(event) {
			$(this).parent(".itemx").parent('.append').remove();
	});
</script>

<script>
		$(document).ready(function(){
			$(".filer_input").filer({
				limit: null,
				maxSize: null,
				extensions: null,
				changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><img src="images/image_add.png" alt="" width="100"></div>',
				showThumbs: true,
				theme: "dragdropbox",
				templates: {
					box: '<ul class="jFiler-items-list jFiler-items-grid row"></ul>',
					item: '<li class="jFiler-item col-lg-3 col-md-4 col-sm-6 col-6">\
					<div class="jFiler-item-container">\
					<div class="jFiler-item-inner">\
					<div class="jFiler-item-thumb">\
					<div class="jFiler-item-status"></div>\
					<div class="jFiler-item-thumb-overlay">\
					<div class="jFiler-item-info">\
					<div style="display:table-cell;vertical-align: middle;">\
					<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
					<span class="jFiler-item-others">{{fi-size2}}</span>\
					</div>\
					</div>\
					</div>\
					{{fi-image}}\
					</div>\
					<div class="jFiler-item-assets jFiler-row">\
					<ul class="list-inline pull-left">\
					<input type="text" name="stthinh[]" class="stthinh form-control" placeholder="Nhập STT" />\
					</ul>\
					<ul class="list-inline pull-right">\
					<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
					</ul>\
					</div>\
					</div>\
					</div>\
					</li>',
					itemAppend: '<li class="jFiler-item">\
					<div class="jFiler-item-container">\
					<div class="jFiler-item-inner">\
					<div class="jFiler-item-thumb">\
					<div class="jFiler-item-status"></div>\
					<div class="jFiler-item-thumb-overlay">\
					<div class="jFiler-item-info">\
					<div style="display:table-cell;vertical-align: middle;">\
					<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
					<span class="jFiler-item-others">{{fi-size2}}</span>\
					</div>\
					</div>\
					</div>\
					{{fi-image}}\
					</div>\
					<div class="jFiler-item-assets jFiler-row">\
					<ul class="list-inline pull-left">\
					<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
					</ul>\
					<ul class="list-inline pull-right">\
					<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
					</ul>\
					</div>\
					</div>\
					</div>\
					</li>',
					progressBar: '<div class="bar"></div>',
					itemAppendToEnd: false,
					canvasImage: true,
					removeConfirmation: true,
					_selectors: {
						list: '.jFiler-items-list',
						item: '.jFiler-item',
						progressBar: '.bar',
						remove: '.jFiler-item-trash-action'
					}
				},
				dragDrop: {
					dragEnter: null,
					dragLeave: null,
					drop: null,
					dragContainer: null,
				},
				files: null,
				addMore: true,
				allowDuplicates: false,
				clipBoardPaste: true,
				excludeName: null,
				beforeRender: null,
				afterRender: null,
				beforeShow: null,
				beforeSelect: null,
				onSelect: null,
				afterShow: null,
				onEmpty: null,
				options: null,
				dialogs: {
					alert: function(text) {
						return alert(text);
					},
					confirm: function (text, callback) {
						confirm(text) ? callback() : null;
					}
				},
				captions: {
					button: "Choose Files",
					feedback: "Choose files To Upload",
					feedback2: "files were chosen",
					drop: "Drop file here to Upload",
					removeConfirmation: "Are you sure you want to remove this file?",
					errors: {
						filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
						filesType: "Only Images are allowed to be uploaded.",
						filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
						filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
					}
				}
			});
		})

	</script>
