<script type="text/javascript">
  $(document).ready(function() {
    $('.update_stt').keyup(function(event) {
      var id = $(this).attr('rel');
      var table = 'product_attributes';
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
      window.location.href="index.php?com=product&act=man_attr&product_id=<?php echo $_GET['product_id']?>&type=<?=$_GET['type']?>&keyword="+keyword;
    });
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=product&act=delete_attr&product_id=<?php echo $_GET['product_id']?>&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
  });
  function select_list()
  {
    var a=document.getElementById("id_list");
    window.location ="index.php?com=product&act=man_attr&product_id=<?php echo $_GET['product_id'] ?>&type=<?=$_GET['type']?>&id_list="+a.value; 
    return true;
  }
</script> 
<?php
function get_main_list()
{
  $sql="select * from table_product_list where type='thong-so' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
  <option value="">Chọn group</option>';
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
<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thuôc tính sản phẩm</span></a></li>
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
  <h1><?php $sanpham = _fetch_array("SELECT ten_vi as ten from table_product where id='".$_GET['product_id']."'"); echo $sanpham['ten']?></h1>
    <div style="float:left;">
      <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=product&type=<?=$_GET['type']?>&act=add_attr&product_id=<?php echo $_GET['product_id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
      <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />
    </div>  
  </div>

  <div class="widget">
    <div class="title"><span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
    
  </div>
  <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
        <tr>
          <td></td>
          <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
          <td class="sortCol"><div>Label<span></span></div></td>
          <td class="sortCol"><div>Value<span></span></div></td>
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
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
          </td> 
          <td class="title_name_data">
            <a href="index.php?com=product&act=edit_attr&product_id=<?php echo $_GET['product_id']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['label_vi']?></a>
          </td>

          <td class="title_name_data">
            <a href="index.php?com=product&act=edit_attr&product_id=<?php echo $_GET['product_id']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['value_vi']?></a>
          </td>

          <td class="actBtns">
            <a href="index.php?com=product&act=edit_attr&product_id=<?php echo $_GET['product_id']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=product&act=delete_attr&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>