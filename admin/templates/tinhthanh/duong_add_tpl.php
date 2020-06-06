<h3>Thêm Đường</h3>
<script language="javascript">
	function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=tinhthanh&act=<?php if($_REQUEST['act']=='edit_duong') echo 'edit_duong'; else echo 'add_duong';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+a.value;	
		return true;
	}
	function select_quan()
	{
		var a=document.getElementById("id_cat");
		var b=document.getElementById("id_quan");
		window.location ="index.php?com=tinhthanh&act=<?php if($_REQUEST['act']=='edit_duong') echo 'edit_duong'; else echo 'add_duong';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_cat="+a.value+"&id_quan="+b.value;	
		return true;
	}
</script>
<?php
function get_main_category()
	{
		$sql="select * from table_tinh order by stt asc";
		$stmt=_result_array($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange()" class="main_font">
			<option value="">Chọn danh mục</option>			
			';
		foreach($stmt as $row) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	function get_main_quan()
	{
		$sql="select * from table_quan  where id_cat = '".$_GET['id_cat']."' order by stt asc";
		$stmt=_result_array($sql);
		$str='
			<select id="id_quan" name="id_quan" onchange="select_quan()" class="main_font">
			<option value="">Chọn danh mục</option>			
			';
		foreach($stmt as $row) 
		{
			if($row["id"]==(int)@$_REQUEST["id_quan"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_main_phuong()
	{
		$sql="select * from table_phuong  where id_quan = '".$_GET['id_quan']."' order by stt asc";
		$stmt=_result_array($sql);
		$str='
			<select id="id_phuong" name="id_phuong" onchange="select_phuong()" class="main_font">
			<option value="">Chọn danh mục</option>			
			';
		foreach($stmt as $row) 
		{
			if($row["id"]==(int)@$_REQUEST["id_phuong"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
?>
<form name="frm" method="post" action="index.php?com=tinhthanh&act=save_duong" enctype="multipart/form-data" class="nhaplieu">
<b>Tỉnh Thành : </b> <?=get_main_category()?><br />
<b>Quận Huyện : </b> <?=get_main_quan()?><br />
<b>Phường Xã : </b> <?=get_main_phuong()?><br />

	<b>Đường : </b> <input type="text" name="ten" value="<?=$item['ten']?>" class="input" /><br />

	
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=tinhthanh&act=man'" class="btn" />
</form>