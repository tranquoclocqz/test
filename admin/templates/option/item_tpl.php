<script type="text/javascript">
  $(document).ready(function() {
    $('.update_stt').keyup(function(event) {
      var id = $(this).attr('rel');
      var table = 'option';
      var value = $(this).val();
      $.ajax ({
        type: "POST",
        url: "ajax/update_stt.php",
        data: {id:id,table:table,value:value},
        success: function(result) {
        }
      });
    });
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=option&act=delete&listid=" + listid;
    });
  });
</script> 

<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">      
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
      <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=option&act=add&type=<?php echo $_GET['type'] ?>'" />
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
          <td class="sortCol"><div>Tên<span></span></div></td>        
          <td class="tb_data_small">Ẩn/Hiện</td>
          <td width="200">Thao tác</td>
        </tr>
      </thead>

      <tbody>
       <?php $n = count($item); for($i=0, $count=$n; $i<$count; $i++){?>
         <tr>
           <td>
            <input type="checkbox" name="chon" value="<?=$item[$i]['id']?>" id="check<?=$i?>" />
          </td>
          <td align="center">
            <input type="text" value="<?=$item[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$item[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$item[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
          </td> 


          <td class="title_name_data">
            <a href="index.php?com=option&act=edit&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" class="tipS SC_bold"><?=$item[$i]['ten']?></a>
          </td>   
          <td align="center">
            <a data-val2="table_<?=$_GET['com']?>" rel="<?=$item[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($item[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$item[$i]['id']?>" ></a>   
          </td>

          <td class="actBtns">
            <a href="index.php?com=option&act=edit&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=option&act=man&xoa=<?php echo $item[$i]['id'] ?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>