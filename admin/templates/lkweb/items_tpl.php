<?php 
function get_main_list()
{
  $sql="select * from table_baiviet where type='thanh-vien-cau-lac-bo' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="post_id" name="post_id"  onchange="select_list()" class="main_select">
  <option value="">Chọn thành viên</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["post_id"])
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
     <li><a href="index.php?com=lkweb&act=man"><span>Liên kết website</span></a></li>
     <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
   </ul>
   <div class="clear"></div>
 </div>
</div>
<script language="javascript">
 function select_list()
 {
  var a=document.getElementById("id_list");
  window.location ="index.php?com=lkweb&act=man&type=<?=$_GET['type']?>&post_id="+a.value; 
  return true;
}
function CheckDelete(l){
  if(confirm('Bạn có chắc muốn xoá mục này?'))
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
     <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=lkweb&act=add&type=<?=$_GET['type']?>'" />
     <input type="button" class="blueB" value="Hiện" onclick="ChangeAction('index.php?com=lkweb&act=man&multi=show&type=<?=$_GET['type']?>');return false;" />
     <input type="button" class="blueB" value="Ẩn" onclick="ChangeAction('index.php?com=lkweb&act=man&multi=hide&type=<?=$_GET['type']?>');return false;" />
     <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=lkweb&act=man&multi=del&type=<?=$_GET['type']?>');return false;" />
   </div>    
 </div>



 <div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
  </span>
  <h6>Danh sách liên kết web</h6>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
  <thead>
    <tr>
      <td></td>
      <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
      <?php if ($config_images == "true"): ?>
        <td style="width: 50px"></td>
      <?php endif ?>
      <?php if( $config_list ) { ?>
        <td class="tb_data_small"><?=get_main_list()?></td>
      <?php } ?>
      <td width="200"><div>Tên<span></span></div></td>
      <td class="sortCol"><div><?php if($_GET['type'] != 'live'){ ?>Link <?php } else { ?> Số điện thoại <?php } ?><span></span></div></td>
      <td class="tb_data_small">Ẩn/Hiện</td>
      <td width="200">Thao tác</td>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan="10">
        <div class="text-center">
          <?php echo $paging ?>            
        </div></td>
      </tr>
    </tfoot>
    <tbody>
      <?php for($i=0, $count=count($items); $i<$count; $i++){?>
        <tr>
          <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
          </td>
          <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự danh mục" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('lkweb', '<?=$items[$i]['id']?>')" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
          </td>    
          <?php if ($config_images == "true"): ?>
            <td style="width: 50px;text-align: center">
              <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><img src="<?php echo _upload_hinhanh.$items[$i]['photo'] ?>" alt="" style="background: rgba(125,125,125,.2)"></a>
            </td>   
          <?php endif ?>
          <?php if( $config_list ) { ?>
            <td align="center">
            <?php
            $sql = "select ten_vi from table_baiviet where id='".$items[$i]['post_id']."'";
            $name_danhmuc = _fetch_array($sql);
            echo $name_danhmuc['ten_vi'];
            ?>  
          </td>
          <?php } ?>
          <td>
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
          </td>
          
          <td class="title_name_data">
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['url']?></a>
          </td>
          
          <td align="center">
            <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
          </td>   
          
          <td class="actBtns">
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.php?com=lkweb&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa danh mục"><img src="./images/icons/dark/close.png" alt=""></a>
          </td>
        </tr>
      <?php } ?> 
    </tbody>
  </table>
</div>
</form>               