<h3><a href="index.php?com=tinhthanh&act=add_duong">Thêm Đường</a>&nbsp;&nbsp;&nbsp;Danh mục Tỉnh Thành&nbsp;<?=get_main_category();?>&nbsp;&nbsp;&nbsp;Danh mục Quận Huyện &nbsp;<?=get_main_quan();?>&nbsp;&nbsp;&nbsp;phường xã &nbsp;<?=get_main_phuong();?></h3>
<script language="javascript">
	function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=tinhthanh&act=man_duong&id_cat="+a.value;	
		return true;
	}
	
	function select_quan()
	{
		var a=document.getElementById("id_cat");
		var b=document.getElementById("id_quan");
		window.location ="index.php?com=tinhthanh&act=man_duong&id_cat="+a.value+"&id_quan="+b.value;	
		return true;
	}
	function select_phuong()
	{
		var a=document.getElementById("id_cat");
		var b=document.getElementById("id_quan");
		var c=document.getElementById("id_phuong");
		window.location ="index.php?com=tinhthanh&act=man_duong&id_cat="+a.value+"&id_quan="+b.value+"&id_phuong="+c.value;	
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
<table class="blue_table">
	<tr>
		<th style="width:6%;">Stt</th>
        <th style="width:16%;">Tỉnh Thành</th>
		<th style="width:16%;">Quận Huyện</th>
        <th style="width:16%;">Phường Xã</th>
        <th style="width:16%;">Đường</th>
		<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
		<th style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
        <td align="center" style="width:18%;">
        
		<?php
		$sql_danhmuc1="select ten from table_tinh where id='".$items[$i]['id_cat']."' order by ten asc";
		
	 	$item_danhmuc1 =_fetch_array($sql_danhmuc1);
	 	echo @$item_danhmuc1['ten'];
		?>  
        </td>
        <td align="center" style="width:18%;">
        
		<?php
		$sql_danhmuc1="select ten from table_quan where id='".$items[$i]['id_quan']."' order by ten asc";
		
	 	$item_danhmuc1 =_fetch_array($sql_danhmuc1);
	 	echo @$item_danhmuc1['ten'];
		?>  
        </td>
        <td align="center" style="width:18%;">
        
		<?php
		$sql_danhmuc1="select ten from table_phuong where id='".$items[$i]['id_phuong']."' order by ten asc";
		
	 	$item_danhmuc1 =_fetch_array($sql_danhmuc1);
	 	echo @$item_danhmuc1['ten'];
		?>  
        </td>
    
		<td style="width:16%;"><?=$items[$i]['ten']?></td>
		<td style="width:6%;">
		
		<?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="index.php?com=tinhthanh&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='. $_REQUEST['id_cat'];?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=tinhthanh&act=man&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='. $_REQUEST['id_cat'];?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
         <?php
		 }?>      
        
        </td>
		<td style="width:6%;"><a href="index.php?com=tinhthanh&act=edit_duong&id_cat=<?=$items[$i]['id_cat']?>&id_quan=<?=$items[$i]['id_quan']?>&id_phuong=<?=$items[$i]['id_phuong']?>&id=<?=$items[$i]['id']?>&curPage=<?=$_GET['curPage']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:6%;"><a href="index.php?com=tinhthanh&act=delete_duong&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=tinhthanh&act=add_duong"><img src="media/images/add.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>