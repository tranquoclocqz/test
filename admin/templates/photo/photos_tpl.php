<script type="text/javascript">
 function select_linhvuc()
 {
  var a=document.getElementById("id_linhvuc");
  window.location ="index.php?com=photo&act=man_photo&type=<?=$_GET['type']?>&id_linhvuc="+a.value; 
  return true;
}
</script>
<?php 
function get_linhvuc()
{
  $sql="select * from table_linhvuc where hienthi = 1";
  $d->query($sql);
  $stmt = $d->result_array();
  $str='
  <select id="id_linhvuc" name="id_linhvuc" onchange="select_linhvuc()" class="main_select">
  <option value="">Chọn lĩnh vực</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["id_linhvuc"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}
?>
<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="index.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$title_main?></span></a></li>
     <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
   </ul>
   <div class="clear"></div>
 </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xóa hình ảnh này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}							
</script>
<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
     <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=photo&act=add_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
     <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=photo&act=man_photo&multi=show<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
     <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=photo&act=man_photo&multi=hide<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
     <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=photo&act=man_photo&multi=del<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>');return false;" />
   </div>  
   <div style="float:right;">
    <div class="selector">

    </div>  
  </div>      	  
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
  </span>
  <h6>Danh sách các hình ảnh hiện có</h6>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
  <thead>
    <tr>
      <td></td>
      <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
      <?php if ($config_linhvuc): ?>
        <td class="tb_data_small">
          <?php echo get_linhvuc(); ?>
        </td> 
      <?php endif ?>
      <td width="150">Hình ảnh</td>
      <td class="sortCol"><div>Tên hình<span></span></div></td>
      <?php  if($config_noibat){ ?>     
            <td class="tb_data_small">Nổi bật</td>       
          <?php } ?>
      <td class="tb_data_small">Ẩn/Hiện</td>
      <td width="200">Thao tác</td>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan="10"><div class="pagination"></div></td>
    </tr>
  </tfoot>
  <tbody>
   <?php for($i=0, $count=count($items); $i<$count; $i++){?>
     <tr>
       <td>
        <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
      </td>
      <td align="center">
        <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự hình ảnh" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('photo', '<?=$items[$i]['id']?>')" />
        <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
      </td> 
      <?php if ($config_linhvuc): ?>
        <td align="center">
         <?php
         $tenlinhvuc = _fetch_array("select ten_vi from table_linhvuc where id='".$items[$i]['id_linhvuc']."'");
         echo $tenlinhvuc['ten_vi'];
         ?>  
       </td>
     <?php endif; ?>
     <td align="center">
      <img style="background: #ccc" src="<?=_upload_hinhanh.$items[$i]['photo_vi']?>" width="100" border="0" />
    </td>

    <td class="title_name_data">
      <a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
    </td>
     <?php if($config_noibat){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } ?>
    <td align="center">
      <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
    </td>  

    <td class="actBtns">
      <a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><img src="./images/icons/dark/pencil.png" alt=""></a>
      <a href="" onclick="CheckDelete('index.php?com=photo&act=delete_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'); return false;" title="" class="smallButton tipS" original-title="Xóa hình ảnh"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
    </tr>
  <?php } ?>
</tbody>
</table>
</div>
</form>
<div class="paging"><?=$paging?></div>