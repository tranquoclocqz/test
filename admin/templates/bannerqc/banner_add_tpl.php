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
        <li><a href="index.php?com=bannerqc&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main?></span></a></li>
      </ul>
      <div class="clear"></div>
    </div>
  </div>

  <form name="supplier" id="validate" class="form" action="index.php?com=bannerqc&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="widget">
      <div class="title chonngonngu">
        <ul>
          <?php foreach ($ar_lang as $key => $value): ?>
            <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
          <?php endforeach ?>
        </ul>
      </div>  
      <?php foreach ($ar_lang as $key => $value): ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
          <label>Tải <?=$title_main?> <br> <?php echo $value['ten'] ?></label>
          <div class="formRight">
            <input type="file" id="file_<?php echo $value['slug'] ?>" name="file_<?php echo $value['slug'] ?>" />
            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
            <div class="note"><?php if($_GET['type']=='casekhuyenmai' || $_GET['type']=='casequatang' || $_GET['type']=='thietkethicong'){?> Kích thước tùy chỉnh <?php } else { ?> width : <?php echo _width_thumb*$ratio_;?>px  - Height : <?php echo _height_thumb*$ratio_;?>px<?php } ?></div>
          </div>
          <div class="clear"></div>
        </div>

        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
          <label><?=$title_main?> Hiện Tại <br> <?php echo $value['ten'] ?></label>
          <div class="formRight">

            <div class="mt10">
             <img style="background-color: #cccccc;max-width: 100%;" src="<?=_upload_hinhanh.$item['photo_'.$value['slug']]?>"  style="max-width: 100%;" alt="">
           </div>
         </div>
         <div class="clear"></div>
       </div>    
     <?php endforeach ?>
     <?php if($config_mota){ ?>
      <div class="formRow">
        <label>Mô tả</label>
        <div class="ck_editor">
          <textarea rows="4" cols="" title="Nhập mô tả <?php echo $value['ten'] ?> " class="tipS" id="mota" name="mota"><?=@$item['mota']?></textarea>
        </div>
        <div class="clear"></div>
      </div>
    <?php } ?>      
    <?php if($links_=='true'){?>
      <div class="formRow">
        <label>Link liên kết:</label>
        <div class="formRight">
          <input type="text" id="code_pro" name="link" value="<?=$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
        </div>
        <div class="clear"></div>
      </div>
    <?php }  ?>
 
     <?php if (!empty($item['video'])): ?>
        <div class="formRow">
          <label>Video Hiện Tại :</label>
          <div class="formRight">
            <object width="580" height="435"><param name="movie" value="//www.youtube.com/v/<?=getIDyoutube($item['video'])?>?version=3&amp;hl=vi_VN&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/<?=getIDyoutube($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="300" height="200" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" ></embed></object>
          </div>
          <div class="clear"></div>
        </div>
     <?php endif ?>
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