
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
function get_main_list()
{
	$sql="select * from table_tinh where hienthi = 1 order by ma asc";
	$rows=_result_array($sql);
	$str='
	<select id="ma_tp" name="ma_tp" class="main_select select2 select_danhmuc">
	<option value="">Chọn tỉnh/ thành phố</option>';
	foreach ($rows as $row) 
	{
		if($row["ma"]==(int)@$_REQUEST["ma_tp"])
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["ma"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
	}
	$str.='</select>';
	return $str;
}
?>

<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=tinhthanh&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm quận/ huyện</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=tinhthanh&act=save" method="post" enctype="multipart/form-data">
		<div class="widget">

			<div class="formRow">
				<label>Chọn tỉnh/ thành phố </label>
				<div class="formRight">
					<?=get_main_list()?>
				</div>
				<div class="clear"></div>
			</div>	
			
				<div class="formRow">
					<label>Tiêu đề</label>
					<div class="formRight">
						<input type="text" name="ten_vi" title="Nhập tên quận huyện" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
					</div>
					<div class="clear"></div>
				</div>
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
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=tinhthanh&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        
</div>
