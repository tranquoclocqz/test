<?php 
function get_main_list()
{
	global $item;
	$sql="select ten_vi,id from table_baiviet where type='thanh-vien-cau-lac-bo' order by stt asc";
	$stmt=_result_array($sql);
	$str='
	<select id="cbo_post_id" name="post_id" class="main_select select2">
	<option value="">Chọn thành viên</option>';
	foreach ($stmt as $row) 
	{
		if($row["id"]==(int)@$item["post_id"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}
?>
<script type="text/javascript">	
	function TreeFilterChanged2(){
		
		$('#validate').submit();
	}
</script>
<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=lkweb&act=man"><span>Quản lý  <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=lkweb&act=save&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Nhập dữ liệu</h6>
			</div>
			<?php if($config_images == "true"){ ?>
				<div class="formRow">
					<label>Tải hình ảnh:</label>
					<div class="formRight">
						<input type="file" id="file" name="file" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<?php if (!$config_auto): ?>
							<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
						<?php endif ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Hình Hiện Tại :</label>
						<div class="formRight">
							<div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" width="40" /></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if( $config_list ) { ?>
			<div class="formRow">
				<label>Chọn thành viên </label>
				<div class="formRight">
					<?=get_main_list()?>
				</div>
				<div class="clear"></div>
			</div>	
			<?php } ?>
			<div class="formRow">
				<label>Tên</label>
				<div class="formRight">
					<input type="text" name="ten" title="Nhập tên website" id="name" class="tipS validate[required]" value="<?=@$item['ten']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label><?php if($_GET['type']=='live'){ ?> Số điện thoại <?php }else{ ?>Link <?php } ?></label>
				<div class="formRight">
					<input type="text" name="url" title="Nhập link website" id="url" class="tipS validate[required]" value="<?=@$item['url']?>" />
				</div>
				<div class="clear"></div>
			</div>



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
					<input type="hidden" name="id" id="id_this_lkweb" value="<?=@$item['id']?>" />
					<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>

		</div>  

	</form>        </div>