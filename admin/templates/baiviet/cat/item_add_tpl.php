
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
	});
</script>
<?php
function get_linhvuc()
{	
	global $item;
	$sql="select * from table_linhvuc where hienthi = 1";
	$stmt=_result_array($sql);
	$str='
	<select id="id_linhvuc" name="id_linhvuc" class="main_select select2" data-target="id_list" data-type="'.$_GET['type'].'" data-table="table_baiviet_list">
	<option value="">Chọn lĩnh vực</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["id_linhvuc"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}

function get_main_list()
{
	$sql="select * from table_baiviet_list where type='".$_GET['type']."' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="id_list" name="id_list" class="main_select select2">
	<option value="">Chọn danh mục 1</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$_REQUEST["id_list"])
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
				<li><a href="index.php?com=baiviet&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm Danh mục cấp 2</span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=baiviet&act=save_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">

			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>				
			<?php if ($config_linhvuc): ?>
				<div class="formRow">
					<label>Chọn danh mục </label>
					<div class="formRight">
						<?=get_linhvuc()?>
					</div>
					<div class="clear"></div>
				</div>	
			<?php endif ?>
			<div class="formRow">
				<label>Chọn danh mục </label>
				<div class="formRight">
					<?=get_main_list()?>
				</div>
				<div class="clear"></div>
			</div>	
			<?php if($config_images){ ?>
				<div class="formRow">
					<label>Tải hình ảnh:</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit_cat'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">

							<div class="mt10"><img src="<?=_upload_baiviet.$item['thumb']?>"  alt="NO PHOTO"  /></div>
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
			<?php } ?>
			<?php include _template."handle_slug.php" ?>
			<?php foreach ($ar_lang as $key => $value){ ?>		
				<?php if($config_mota){ ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Mô tả <br> <?php echo $value['ten'] ?> </label>
						<div class="formRight">
							<textarea rows="4" cols="" title="Nhập mô tả <?php echo $value['ten'] ?> " class="tipS" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>								

				<?php if($config_mota_ckeditor){ ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Mô tả <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="mota_<?php echo $value['slug'] ?>" name="mota_<?php echo $value['slug'] ?>"><?=@$item['mota_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>																	
				<?php }?>
				<?php if ($config_noidung): ?>
					<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
						<label>Nội dung <?php echo $value['ten'] ?></label>
						<div class="ck_editor">
							<textarea id="noidung_<?php echo $value['slug'] ?>" name="noidung_<?php echo $value['slug'] ?>"><?=@$item['noidung_'.$value['slug']]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				<?php endif ?>
			<?php } ?>
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
					<a href="index.php?com=baiviet&act=man_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        </div>
