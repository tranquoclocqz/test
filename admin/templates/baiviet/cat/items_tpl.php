<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'baiviet_cat';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});
		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=baiviet&act=man_cat&type=<?=$_GET['type']?>&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=baiviet&act=delete_cat&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
  });
  function select_linhvuc()
  {
    var a=document.getElementById("id_linhvuc");
    window.location ="index.php?com=baiviet&act=man_cat&type=<?=$_GET['type']?>&id_linhvuc="+a.value; 
    return true;
  }
  function select_list()
  {
    var a=document.getElementById("id_list");
    var b=document.getElementById("id_linhvuc");
    window.location ="index.php?com=baiviet&act=man_cat&type=<?=$_GET['type']?>&id_list="+a.value<?php if (isset($_GET['id_linhvuc'])): ?>
    +"&id_linhvuc="+b.value
    <?php endif ?>; 
    return true;
  }
</script>
<?php
function get_main_list()
{
  $sql="select * from table_baiviet_list where type='".$_GET['type']."' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
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
function get_linhvuc()
{
  $sql="select * from table_linhvuc where hienthi = 1";
  $stmt=_result_array($sql);
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
     <li><a href="index.php?com=baiviet&act=man_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục cấp 2</span></a></li>
     <?php if($_GET['keyword']!=''){ ?>
       <li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
     <?php }  else { ?>
       <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
     <?php } ?>
   </ul>
   <div class="clear"></div>
 </div>
</div>


<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
     <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=baiviet&type=<?=$_GET['type']?>&act=add_cat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
     <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

   </div>  
 </div>

 <div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
  </span>
  <h6>Chọn tất cả</h6>
  <div class="timkiem">
   <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
   <button type="button" class="blueB"  value="">Tìm kiếm</button>
 </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
  <thead>
    <tr>
      <td></td>
      <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
      <td class="tb_data_small"><?=get_main_list()?></td>       
      <?php if ($config_images): ?>
      <td></td>
      <?php endif ?>
      <td class="sortCol"><div>Tên danh mục<span></span></div></td>
      <?php if ($config_noibat): ?>
        <td>Trang chủ</td>  
      <?php endif ?>
      <td class="tb_data_small">Ẩn/Hiện</td>
      <td width="200">Thao tác</td>
    </tr>
  </thead>

  <tbody>
   <?php for($i=0, $count=count($items); $i<$count; $i++){?>
     <tr>
       <td>
        <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
      </td>
      <td align="center">
        <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />

        <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
      </td>
      <td align="center">
      <?php
      $sql = "select ten_vi from table_baiviet_list where id='".$items[$i]['id_list']."'";
      $name_danhmuc = _fetch_array($sql);
      echo @$name_danhmuc['ten_vi'];
      ?>  
    </td> 
     <?php if ($config_images): ?>
      <td style="width: 50px">
        <div>
          <a href="index.php?com=baiviet&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
            <img src="<?php echo _upload_baiviet.$items[$i]['photo'] ?>" alt="" class="img-responsive img-center">
          </a>
        </div>
      </td>
    <?php endif ?>    
    <td class="title_name_data">
      <a href="index.php?com=baiviet&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
    </td>
    <?php if($config_noibat){ ?> 
      <td align="center">
        <a data-val2="table_<?=$_GET['com']?>_cat" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
      </td>
    <?php } ?>
    <td align="center">
      <a data-val2="table_<?=$_GET['com']?>_cat" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
    </td>    
    <td class="actBtns">
      <a href="index.php?com=baiviet&act=edit_cat&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/pencil.png" alt=""></a>

      <a href="index.php?com=baiviet&act=delete_cat&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a>
    </td>
  </tr>
<?php } ?>
</tbody>
</table>
</div>
</form>

<div class="paging"><?=$paging?></div>