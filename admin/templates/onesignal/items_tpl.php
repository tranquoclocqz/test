<script type="text/javascript">
  $(document).ready(function() {
    $('.update_stt').keyup(function(event) {
      var id = $(this).attr('rel');
      var table = 'product_list';
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
      window.location.href="index.php?com=product&act=man_list&type=<?=$_GET['type']?>&keyword="+keyword;
    });
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=product&act=delete_list&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
  });
</script> 

<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục cấp 1</span></a></li>
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
      <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=onesignal&act=add';" />

    </div>  
  </div>

  <div class="widget">
  <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
        <tr>
          <td align="center">STT</td>
          <td width="75" align="center"></td>
          <td align="center">Tên</td>
          <td align="center">Mô tả</td>
          <td align="center">Đường dẫn</td>
          <td width="50" align="center">Đẩy tin</td>
          <td align="center">Tùy chỉnh</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $key => $value): ?>
          <tr>
            <td align="center"><?php echo $key + 1 ?></td>                
            <td align="center"><img style="max-width: 50px" src="<?php echo _upload_hinhanh.$value['photo'] ?>" alt=""></td>                
            <td align="center">
              <a href="index.php?com=onesignal&act=edit&id=<?php echo $value['id'] ?>" title="<?php echo $value['ten'] ?>"><?php echo $value['ten'] ?></a>
            </td>
            <td align="center">
              <?php echo $value['noidung'] ?>
            </td>
            <td align="center">
              <a  href="index.php?com=onesignal&act=edit&id=<?php echo $value['id'] ?>" title="<?php echo $value['link'] ?>"><?php echo $value['link'] ?></a>
            </td>
            <td align="center">
              <a href="index.php?com=onesignal&act=push&id=<?php echo $value['id'] ?>" class="btn-push">Đẩy tin</a>
            </td>
            <td class="btnOne" align="center">

              <a class="smallButton tipS" href="index.php?com=onesignal&act=edit&id=<?=$value['id']?>">
                <img src="./images/icons/dark/pencil.png" alt="">
              </a>
              <a class="smallButton tipS" href="index.php?com=onesignal&delete=<?=$value['id']?>">
                <img src="./images/icons/dark/close.png" alt="">
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>