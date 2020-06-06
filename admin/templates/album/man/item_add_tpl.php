
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
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'album_photo';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});

		$('.delete_images').click(function(){
			if (confirm('Bạn có muốn xóa hình này ko ? ')) {
				var id = $(this).attr('title');
				var table = 'album_photo';
				var links = "<?=_upload_album?>";
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

		$('.delete').click(function(e) {
			$(this).parent().remove();
		});
	});

</script>
<?php

function get_main_list()
{
	global $item;
	$sql="select * from table_album_list where type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_list" name="id_list" data-level="0"  data-type="'.$_GET['type'].'" data-child="id_cat"  class="main_select select_danhmuc select2">
	<option value="">Chọn danh mục 1</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_list"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

?>
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=album&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=album&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php if($config_list){?>
				<div class="formRow">
					<label>Chọn danh mục 1</label>
					<div class="formRight">
						<?=get_main_list()?>
					</div>
					<div class="clear"></div>
				</div>

			<?php } ?>

			<?php if($config_images){?>
				<div class="formRow">
					<label>Tải hình ảnh:</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10"><img src="../thumb/<?php echo _width_thumb ?>x<?php echo _height_thumb ?>/<?php echo _style_thumb ?>/<?=_upload_album_l.$item['photo']?>"  alt="NO PHOTO" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>

			<?php if($config_files){?>
				<div class="formRow">
					<label>Tải file:</label>
					<div class="formRight">
						<input type="file" id="file" name="file_2" />
						<img src="./images/question-button.png" alt="Upload file" class="icon_question tipS" original-title="Tải file (file PDF, DOC, DOCX, XLSX)">
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>FILE Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10"><strong><?=$item['photo_2']?></strong></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>
			<?php foreach ($ar_lang as $key => $value){ ?>				
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề <br> <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
				<?php if ($config_mota): ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Mô tả <br> <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" id="mota_<?php echo $value['slug'] ?>" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
		<?php } ?>
		<?php if($config_mul){ ?>
			<div class="formRow">
				<label>Hình ảnh kèm theo: </label>
				<div class="formRight">
					<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif">
						<img src="images/image_add.png" alt="" width="100">

					</a>
					<?php if(count($ds_photo)!=0){?>
						<div class="clear_gal">   
							<?php for($i=0;$i<count($ds_photo);$i++){?>
								<div class="item_trich">
									<div class="border-box">
										<div>
											<img class="img_trich" src="../thumb/148x135/2/<?=_upload_album_l.$ds_photo[$i]['photo']?>" />
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
		<?php if($config_noidung == 'true'){ ?>
			<div class="formRow lang_hidden lang_vi active">
				<label>Nội Dung</label>
				<div class="ck_editor">
					<textarea  rows="4" id="noidung_vi" name="noidung_vi"><?=@$item['noidung_vi']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<?php if($config_en){ ?>
				<div class="formRow lang_hidden lang_en">
					<label>Nội Dung (Tiếng Anh)</label>
					<div class="ck_editor">
						<textarea  rows="4" id="noidung_en" name="noidung_en"><?=@$item['noidung_en']?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			<?php }} ?>
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
					<a href="index.php?com=album&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        </div>
	<script>
		$(document).ready(function() {
			$('.file_input').filer({
				changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
				showThumbs: true,
				theme: "dragdropbox",
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
					</div>\<input type="text" name="stthinh[]" class="stthinh" />\
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
					</div>\<input type="text" name="stthinh[]" class="stthinh" />\
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
				dragDrop: {
					dragEnter: null,
					dragLeave: null,
					drop: null,
				},
				addMore: true
			});
		});
	</script>
