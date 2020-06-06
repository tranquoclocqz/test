<script type="text/javascript">   

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
<div class="wrapper">
  <div class="control_frm" style="margin-top:25px;">
    <div class="bc">
      <ul id="breadcrumbs" class="breadcrumbs">
        <li><a href="index.php?com=audio&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main?></span></a></li>
      </ul>
      <div class="clear"></div>
    </div>
  </div>

  <form name="supplier" id="validate" class="form" action="index.php?com=audio&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="widget">

      <div class="formRow lang_hidden lang_vi active">
        <label>Tải <?=$title_main?></label>
        <div class="formRight">
          <input type="file" id="file_vi" name="file_vi" />
          <img src="./images/question-button.png" alt="Upload file" class="icon_question tipS" original-title="Tải file">
        </div>
        <div class="clear"></div>
      </div>

      <div class="formRow lang_hidden lang_vi active">
        <label><?=$title_main?> Hiện Tại</label>
        <div class="formRight">

          <div class="mt10">
            <audio controls>
              <source src="<?php echo _upload_hinhanh.$item['photo_vi'] ?>" type="audio/mpeg">
                </audio>
              </div>
            </div>
            <div class="clear"></div>
          </div>    
          <?php if($config_hienthi=='true'){?>
            <div class="formRow">
              <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
              <div class="formRight">
                <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
              </div>
              <div class="clear"></div>
            </div>
          <?php } ?>


          <div class="formRow">
            <div class="formRight">
              <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
          </div>

        </div> 




      </form></div>