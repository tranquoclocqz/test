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
			var table = 'product_photo';
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

		$('.themmoi').click(function(e) {
			$.ajax ({
				type: "POST",
				url: "ajax/khuyenmai.php",
				success: function(result) { 
					$('.load_sp').append(result);
				}
			});
		});

		$('.delete').click(function(e) {
			$(this).parent().remove();
		});
		

	});


	$(function(){
		$("#states").select2({
			tags: true,
			tokenSeparators: [",", " "],
			language: "vi",
			placeholder: "Từ khóa sản phẩm",
		});
	});

	$(function(){
		$("#states2").select2();
		$("#states2").change(function(){
			$idtin = $(this).val();
			if($idtin>0){
				$("#tags_name").append("<p class='delete_tags'>"+$("#states2 option:selected").text()+"<input name='idtin[]' value='"+$idtin+"'  type='hidden' /> <span></span> </p>");
			}
			$(".delete_tags span").click(function(){
				$(this).parent().remove();
			});
		});
		$(".delete_tags span").click(function(){
			$(this).parent().remove();
		});
	});

</script>
<?php
function get_main_list()
{
	global $item;
	$sql="select * from table_product_list where type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" data-table="table_product_cat" data-child="id_cat" class="main_select select2 select_danhmuc">
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

function get_nhasanxuat()
{
	global $item;
	$sql="select * from table_nhasanxuat order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select style="width:300px;" id="state3" name="id_nsx" class="main_select
	select_danhmuc select2">
	<option value="">Chọn thương hiệu</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_nsx"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

function get_main_cat()
{
	global $item;
	$sql="select * from table_product_cat where id_list='".$item['id_list']."' and type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_cat" name="id_cat" data-level="1" data-type="'.$_GET['type'].'" data-table="table_product_item" data-child="id_item" class="main_select select2 select_danhmuc">
	<option value="">Chọn danh mục 2</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_cat"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

function get_main_item()
{
	global $item;
	$sql="select * from table_product_item where id_cat='".$item['id_cat']."' and type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_item" name="id_item" data-level="2" data-type="'.$_GET['type'].'" data-table="table_product_sub" data-child="id_sub" class="main_select select2  select_danhmuc">
	<option value="">Chọn danh mục 3</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_item"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}
function get_main_sub()
{
	global $item;
	$sql="select * from table_product_sub where id_item='".$item['id_item']."' and type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_sub" name="id_sub" class="main_select select2">
	<option value="">Chọn danh mục 3</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_sub"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

function product_tinh()
{
	global $item;
	$sql="select * from table_tinh order by ma asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_tinh" name="id_tinh" data-level="0" " data-table="table_quan" data-child="id_quan" class="main_select select2 select_danhmuc">
	<option value="">Chọn tỉnh/ thành phố</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_tinh"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

function product_quan()
{
	global $item;
	$sql="select * from table_quan where id_list ='".$item['id_tinh']."' order by ma_tp asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_quan" name="id_quan" class="main_select select2">
	<option value="">Chọn quận/ huyện</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_quan"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

?>
<input type="hidden" id="id_list_hidden" value="<?=$_GET['id_list']?>">
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">

			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<?php if($config_list){ ?>
				<div class="formRow">
					<label>Chọn danh mục 1</label>
					<div class="formRight">
						<?=get_main_list()?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if($config_cat){ ?>
				<div class="formRow">
					<label>Chọn danh mục 2</label>
					<div class="formRight">
						<?=get_main_cat()?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if($config_item){ ?>
				<div class="formRow">
					<label>Chọn danh mục 3</label>
					<div class="formRight">
						<?=get_main_item()?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if($config_sub){ ?>
				<div class="formRow">
					<label>Chọn danh mục 4</label>
					<div class="formRight">
						<?=get_main_sub()?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if($config_nhasanxuat){ ?>
				<div class="formRow">
					<label>Chọn thương hiệu: </label>
					<div class="formRight">
						<?=get_nhasanxuat()?>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
					<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

					<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>

				</div>
				<div class="clear"></div>
			</div>
			<?php if($_GET['act'] == 'edit'){?>
				<div class="formRow">
					<label>Hình Hiện Tại :</label>
					<div class="formRight">
						<div class="mt10" style="max-width: 250px"><img class="img-responsive" src="<?php echo _upload_product.$item['photo']?>" style="max-width: 100%;"  alt="NO PHOTO" /></div>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>

			<?php if( $config_images2 ) { ?>
				<div class="formRow">
					<label>Tải hình ảnh 2:</label>
					<div class="formRight">
						<input type="file" id="file2" name="file2" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">

						<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>

					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act'] == 'edit'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">
							<div class="mt10" style="max-width: 250px"><img class="img-responsive" src="<?php echo _upload_product.$item['photo_2']?>" style="max-width: 100%;"  alt="NO PHOTO" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>

			<?php if($config_mul){ ?>
				<div class="formRow">
					<label>Hình ảnh kèm theo: </label>
					<div class="formRight">
						<input type="file" name="files[]" id="filer_input" class="filer_input" multiple="multiple">
						<div class="clear"></div>       
						<?php if($act=='edit' && count($ds_photo)!=0){?>
							<div class="clear_gal">       
								<?php for($i=0;$i<count($ds_photo);$i++){?>
									<div class="item_trich">
										<div class="border-box">
											<div>
												<img class="img_trich" src="../thumb/148x135/2/<?php echo _upload_product_l.$ds_photo[$i]['photo']; ?>" />
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
			<?php if($config_tags){ 
				$tags_arr = _result_array("select id,ten_vi from #_tags WHERE type like '".$_GET['type']."'");
				$arr_tags = explode(',', @$item['tags']);$arr_tags2 = explode(',', @$item['tags2']);
				?>
				<div class="formRow">
					<label>Tags </label>
					<div class="formRight">
						<select style="width:100%" multiple id="states" class="select2" name="tags[]">
							<?php foreach ($tags_arr as $value) { ?>
								<option <?php if(in_array($value['id'], @$arr_tags)){echo 'selected';} ?> value="<?=$value["id"]?>"><?=$value["ten_vi"]?></option>
							<?php }?>
						</select>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>	
			
			<div class="formRow">
				<label>Giá bán</label>
				<div class="formRight">
					<input type="text" name="giaban" title="Nhập giá bán" id="giaban" class="tipS" value="<?=@$item['giaban']?>" />
				</div>
				<div class="clear"></div>
			</div>

			
			<div class="formRow">
				<label>Loại nhà</label>
				<div class="formRight">
					<input type="text" name="loainha" title="Nhập loại nhà" id="loainha" class="tipS" value="<?=@$item['loainha']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Hướng</label>
				<div class="formRight">
					<input type="text" name="huong" title="Nhập hướng" id="huong" class="tipS" value="<?=@$item['huong']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Diện tích</label>
				<div class="formRight">
					<input type="text" name="dien_tich" title="Nhập diện tích" id="dien_tich" class="tipS" value="<?=@$item['dien_tich']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Địa chỉ</label>
				<div class="formRight">
					<input type="text" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
				</div>
				<div class="clear"></div>
			</div>


			<div class="formRow">
				<label>Tên liên lạc</label>
				<div class="formRight">
					<input type="text" name="ten_lien_lac" title="Nhập tên liên lạc" id="ten_lien_lac" class="tipS" value="<?=@$item['ten_lien_lac']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Địa chỉ liên lạc</label>
				<div class="formRight">
					<input type="text" name="dia_chi_lien_lac" title="Nhập địa chỉ liên lạc" id="dia_chi_lien_lac" class="tipS" value="<?=@$item['dia_chi_lien_lac']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Điện thoại liên lạc</label>
				<div class="formRight">
					<input type="text" name="dien_thoai_lien_lac" title="Nhập điện thoại liên lạc" id="dien_thoai_lien_lac" class="tipS" value="<?=@$item['dien_thoai_lien_lac']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Email liên lạc</label>
				<div class="formRight">
					<input type="text" name="email_lien_lac" title="Nhập email liên lạc" id="email_lien_lac" class="tipS" value="<?=@$item['email_lien_lac']?>" />
				</div>
				<div class="clear"></div>
			</div>	


			
			<?php foreach ($ar_lang as $key => $value){ ?>
				<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
					<label>Tiêu đề <br> <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>	
			<?php } ?>
			<?php include _template."handle_slug.php" ?>
			<?php foreach ($ar_lang as $key => $value){ ?>
				<?php if($config_mota_ngan) { ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Mô tả ngắn <br> <?php echo $value['ten'] ?></label>
						<div class="formRight">
							<textarea id="mota_ngan_<?php echo $value['slug'] ?>" name="mota_ngan_<?php echo $value['slug'] ?>" rows="7"><?=@$item['mota_ngan_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
				<?php if($config_mota) { ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Mô tả <br> <?php echo $value['ten'] ?></label>
						<div <?php if($config_mota_ckeditor){ ?> class="ck_editor" <?php } else { ?> class="formRight" <?php } ?>>
							<textarea id="mota_<?php echo $value['slug'] ?>" name="mota_<?php echo $value['slug'] ?>" rows="7"><?=@$item['mota_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>

				<?php if($config_noidung) { ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Nội dung <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?php echo $item['noidung_'.$value['slug']]; ?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>

				<?php if($config_thongso){ ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Thông số kỹ thuật <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="thongso_<?php echo $value['slug'] ?>" name="thongso_<?php echo $value['slug'] ?>"><?=@$item['thongso_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>	

			<div class="formRow">
				<label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> /></label>
				<div class="formRight">			
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
					<a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        </div>



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
