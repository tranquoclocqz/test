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
      if (hoi==true) document.location = "index.php?com=option&act=delete_lang&listid=" + listid;
    });
  });
</script> 

<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">      

      <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
    </ul>
    <div class="clear"></div>
  </div>
</div>

<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
    <div style="float:left;">
    </div>  
  </div>
  <?php if( $config['edit'] ) { ?>
   <a href="index.php?com=option&act=add_lang&type=lang" class="btn btn-primary">Thêm</a>
 <?php } ?>
 <div class="widget">

  <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
        <tr>
          <td class="sortCol"><div>Tên<span></span></div></td>   
          <?php if( $config['edit'] ) { ?>
            <td class="sortCol"><div>Name<span></span></div></td>   
          <?php } ?>
          <?php foreach ($ar_lang as $key => $value): ?>
            <td class="sortCol"><div><?php echo $value['ten'] ?><span></span></div></td>        
          <?php endforeach ?>     
          
          <td width="200">Thao tác</td>
        </tr>
      </thead>

      <tbody>
       <?php $n = count($item); for($i=0, $count=$n; $i<$count; $i++){ $lang_value = json_decode($item[$i]['value'],true) ?>
       <tr>
        <td class="title_name_data">
          <a href="index.php?com=option&act=edit_lang&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" class="tipS SC_bold"><?=$item[$i]['ten']?></a>
        </td>   
        <?php if( $config['edit'] ) { ?>
          <td class="title_name_data">
          <a href="index.php?com=option&act=edit_lang&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" class="tipS SC_bold"><?=$item[$i]['name']?></a>
        </td>  
        <?php } ?>
        <?php foreach ($ar_lang as $key => $value): ?>
          <td class="title_name_data">
            <a href="index.php?com=option&act=edit_lang&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" class="tipS SC_bold"><?php echo $lang_value[$value['slug']] ?></a>
          </td>        
        <?php endforeach ?>

        <td class="actBtns">
          <a href="index.php?com=option&act=edit_lang&id=<?php echo $item[$i]['id'] ?>&type=<?php echo $_GET['type'] ?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>

        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>