<script type="text/javascript">
  $(document).ready(function() {
    $('.chonngonngu li a').click(function(event) {
      var lang = $(this).attr('href');
      $('.chonngonngu li a').removeClass('active');
      $(this).addClass('active');
      $('.lang_hidden').removeClass('active');
      $('.lang_' + lang).addClass('active');
      return false;
    });
  });
</script>
<?php
function get_linhvuc()
{
  global $item,$d;
  $sql = "select * from table_linhvuc where hienthi = 1";
  $d->query($sql);
  $stmt = $d->result_array($sql);
  $str = '
  <select id="id_linhvuc" name="id_linhvuc" class="main_select select2" data-target="id_list" data-type="' . $_GET['type'] . '" data-table="table_baiviet_list">
  <option value="">Chọn lĩnh vực</option>';
  foreach ($stmt as $row) {
    if ($row["id"] == (int) @$item["id_linhvuc"])
      $selected = "selected";
    else
      $selected = "";
    $str .= '<option value=' . $row["id"] . ' ' . $selected . '>' . $row["ten_vi"] . '</option>';
  }
  $str .= '</select>';
  return $str;
}
?>
<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=photo&act=man_photo<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>"><span><?= $title_main ?></span></a></li>
      <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
    </ul>
    <div class="clear"></div>
  </div>
</div>
<script type="text/javascript">
  function TreeFilterChanged2() {
    $('#validate').submit();
  }
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=photo&act=save_photo<?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" method="post" enctype="multipart/form-data">
  <div class="widget">
    <?php if (!$config_mul) { ?>
      <div class="title chonngonngu">
        <ul>
          <?php foreach ($ar_lang as $key => $value) : ?>
            <li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php } ?>

    <?php if ($config_mul) { ?>
      <div class="formRow">
        <label>Hình ảnh kèm theo: </label>
        <div class="clear"></div>
        <div class="">
          <input type="file" name="files[]" id="filer_input" class="filer_input" multiple="multiple">
        </div>
        <div class="clear"></div>
      </div>
    <?php } else { ?>
      <?php foreach ($ar_lang as $key => $value) { ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
          <label>Tên hình ảnh <br> <?php echo $value['ten'] ?></label>
          <div class="formRight">
            <input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên hình ảnh <?php echo $value['ten'] ?>" id="name_<?php echo $value['slug'] ?>" class="tipS" value="<?= @$item['ten_' . $value['slug']] ?>" />
          </div>
          <div class="clear"></div>
        </div>
        <?php if ($config_mota == 'true') { ?>
          <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
            <label>Mô tả <br> <?php echo $value['ten'] ?></label>
            <div <?php if ($config_ck) { ?> class="ck_editor" <?php } else { ?> class="formRight" <?php } ?>>
              <textarea rows="4" cols="" title="Nhập mô tả . " class="tipS" id="mota_<?php echo $value['slug'] ?>" name="mota_<?php echo $value['slug'] ?>"><?= @br2nl($item['mota_' . $value['slug']]) ?></textarea>
            </div>
            <div class="clear"></div>
          </div>
        <?php } ?>
      <?php } ?>
    <?php } ?>

    <?php if ($links_ == 'true' && !$config_mul) { ?>
      <div class="formRow">
        <label>Link liên kết:</label>
        <div class="formRight">
          <input type="text" name="link" value="" title="Nhập link liên kết cho hình ảnh" class="tipS" />
        </div>
        <div class="clear"></div>
      </div>
    <?php }  ?>


    <?php if ($config_image) { ?>
      <div class="formRow">
        <label>Tải hình ảnh</label>
        <div class="formRight">
          <input type="file" id="file_vi" name="file_vi" />
          <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
          <?php if (!$config_auto) : ?>
            <span class="note">width : <?php echo _width_thumb * $ratio_; ?>px - Height : <?php echo _height_thumb * $ratio_; ?>px</span>
          <?php endif ?>
        </div>
        <div class="clear"></div>
      </div>
    <?php } ?>


    <?php if ($config_images) { ?>
      <?php foreach ($ar_lang as $key => $value) { ?>
        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
          <label>Tải hình ảnh <br> <?php echo $value['ten'] ?></label>
          <div class="formRight">
            <input type="file" id="file_<?php echo $value['slug'] ?>" name="file_<?php echo $value['slug'] ?>" />
            <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
            <?php if (!$config_auto) : ?>
              <span class="note">width : <?php echo _width_thumb * $ratio_; ?>px - Height : <?php echo _height_thumb * $ratio_; ?>px</span>
            <?php endif ?>
          </div>
          <div class="clear"></div>
        </div>
      <?php } ?>
    <?php } ?>



    <?php if (!$config_mul) : ?>
      <div class="formRow">
        <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
        <div class="formRight">
          <input type="checkbox" name="active<?= $i ?>" id="check1" value="1" checked="checked" />
          <label for="check1">Hiển thị</label>
        </div>
        <div class="clear"></div>
      </div>
      <div class="formRow">
        <label>Số thứ tự: </label>
        <div class="formRight">
          <input type="text" class="tipS" value="1" name="stt<?= $i ?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
        </div>
        <div class="clear"></div>
      </div>
    <?php endif ?>
    <div class="formRow">
      <div class="formRight">
        <input type="hidden" name="type" id="id_this_type" value="<?= $_REQUEST['type'] ?>" />
        <input type="submit" class="blueB" value="Hoàn tất" />
      </div>
      <div class="clear"></div>
    </div>
  </div>
</form>
<script>
    $(document).ready(function(){
    $(".filer_input").filer({
      limit: null,
      maxSize: null,
      extensions: null,
      changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><img src="images/image_add.png" alt="" width="100"></div>',
      showThumbs: true,
      theme: "dragdropbox",
      templates: {
        box: '<div class="widget"><table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable jFiler-items-list jFiler-items-grid row" ><thead><tr><td>Hình ảnh</td><td class="tb_data_small">Số thứ tự</td><td>Nhập tên hình</td><td>Xóa</td></tr></thead></table></div>',
        // box: '<ul class="jFiler-items-list jFiler-items-grid row"></ul>',
        item: '\
        <tr class="item-filter jFiler-item">\
          <td>\
            <div class="img-filter">\
            <div class="jFiler-item-container">\
            <div class="jFiler-item-inner">\
            <div class="jFiler-item-thumb">\
            <div class="jFiler-item-status"></div>\
            <div class="jFiler-item-thumb-overlay">\
            <div class="jFiler-item-info">\
            <div style="display:table-cell;vertical-align: middle;">\
            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
            <span class="jFiler-item-others">{{fi-size2}}</span>\
            </div>\
            </div>\
            </div>\
              {{fi-image}}\
            </div>\
          </td>\
          <td>\
            <input type="text" name="stthinh[]" class="stthinh" placeholder="STT" />\
          </td>\
          <td class="cell_title">\
            <?php foreach ($ar_lang as $value) : ?>
              <input type="text" name="ten_<?php echo $value['slug'] ?>[]" placeholder="Tên hình <?php echo $value['ten'] ?> "/>\
            <?php endforeach; ?>
            <?php if($links_ == "true") { ?><input type="text" name="link[]" placeholder="Link <?php echo $value['ten'] ?> "/>\ <?php } ?>
          </td>\
          <td align="center">\
            <a class="icon-jfi-trash jFiler-item-trash-action"></a>\
          </td>\
        </tr>\
        ',
        itemAppend: '<li class="jFiler-item">\
        <div class="jFiler-item-container">\
        <div class="jFiler-item-inner">\
        <div class="jFiler-item-thumb">\
        <div class="jFiler-item-status"></div>\
        <div class="jFiler-item-thumb-overlay">\
        <div class="jFiler-item-info">\
        <div style="display:table-cell;vertical-align: middle;">\
        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
        <span class="jFiler-item-others">{{fi-size2}}</span>\
        </div>\
        </div>\
        </div>\
        {{fi-image}}\
        </div>\
        <div class="jFiler-item-assets jFiler-row">\
        <ul class="list-inline pull-left">\
        <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
        </ul>\
        <ul class="list-inline pull-right">\
        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
        </ul>\
        </div>\
        </div>\
        </div>\
        </li>',
        progressBar: '<div class="bar"></div>',
        itemAppendToEnd: false,
        canvasImage: true,
        removeConfirmation: true,
        _selectors: {
          list: '.jFiler-items-list',
          item: '.jFiler-item',
          progressBar: '.bar',
          remove: '.jFiler-item-trash-action'
        }
      },
      dragDrop: {
        dragEnter: null,
        dragLeave: null,
        drop: null,
        dragContainer: null,
      },
      files: null,
      addMore: true,
      allowDuplicates: false,
      clipBoardPaste: true,
      excludeName: null,
      beforeRender: null,
      afterRender: null,
      beforeShow: null,
      beforeSelect: null,
      onSelect: null,
      afterShow: null,
      onEmpty: null,
      options: null,
      dialogs: {
        alert: function(text) {
          return alert(text);
        },
        confirm: function (text, callback) {
          confirm(text) ? callback() : null;
        }
      },
      captions: {
        button: "Choose Files",
        feedback: "Choose files To Upload",
        feedback2: "files were chosen",
        drop: "Drop file here to Upload",
        removeConfirmation: "Are you sure you want to remove this file?",
        errors: {
          filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
          filesType: "Only Images are allowed to be uploaded.",
          filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
          filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
        }
      }
    });
  })

  </script>