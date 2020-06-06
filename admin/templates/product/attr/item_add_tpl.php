<?php
function get_main_list()
{
    global $item;
    $sql = "select * from table_product_list where type='thong-so' order by stt asc";
    $stmt = _result_array($sql);
    $str = '
	<select id="id_list" name="id_list[]" class="main_select select_danhmuc">
	<option value="">Chọn group</option>';
    foreach ($stmt as $row) {
        if ($row["id"] == (int) @$item["group_id"])
            $selected = "selected";
        else
            $selected = "";
        $str .= '<option value=' . $row["id"] . ' ' . $selected . '>' . $row["ten_vi"] . '</option>';
    }
    $str .= '</select>';
    return $str;
}
?>

<div class="wrapper">
<h1><?php $sanpham = _fetch_array("SELECT ten_vi as ten from table_product where id='".$_GET['product_id']."'"); echo $sanpham['ten']?></h1>
    <div class="control_frm" style="margin-top:25px;">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="index.php?com=product&act=add_attr&product_id=<?php echo $_GET['product_id'] ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>"><span>Thêm thông số kỹ thuật</span></a></li>
                <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_attr&product_id=<?php echo $_GET['product_id'] ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" method="post" enctype="multipart/form-data">
    <?php if ( $_GET['act'] == 'edit_attr' ) { ?> 

        <div>
                <div class="widget">
                    <?php foreach ($ar_lang as $key => $value) : ?>
                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Label <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="label_<?php echo $value['slug'] ?>" title="Nhập label <?php echo $value['ten'] ?>" id="label_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['label_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Value <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="value_<?php echo $value['slug'] ?>" title="Nhập value <?php echo $value['ten'] ?>" id="value_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['value_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

    <?php } else { ?>
    
        <div id="container_append">
            <div>
                <div class="widget">
                    
                    <?php foreach ($ar_lang as $key => $value) : ?>
                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Label <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="label_<?php echo $value['slug'] ?>[]" title="Nhập label <?php echo $value['ten'] ?>" id="label_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['label_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Value <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="value_<?php echo $value['slug'] ?>[]" title="Nhập value <?php echo $value['ten'] ?>" id="value_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['value_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div id="clone">
                <div class="widget">
                    <?php foreach ($ar_lang as $key => $value) : ?>
                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Label <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="label_<?php echo $value['slug'] ?>[]" title="Nhập label <?php echo $value['ten'] ?>" id="label_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['label_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
                            <label>Value <br> <?php echo $value['ten'] ?></label>
                            <div class="formRight">
                                <input type="text" name="value_<?php echo $value['slug'] ?>[]" title="Nhập value <?php echo $value['ten'] ?>" id="value_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?= @$item['value_' . $value['slug']] ?>" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach ?>
                    <div class="formRow">
                        <label></label>
                        <div class="formRight">
                        
                            <button class="btn btn-danger btn-xoa-thuoc-tinh" type="button">Xóa</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="widget">
            <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
                <h6></h6>
            </div>
            <div class="formRow">
                <div class="formRight">
                    <input type="hidden" name="type" id="id_this_type" value="<?= $_REQUEST['type'] ?>" />
                    <input type="hidden" name="id" id="id_this_post" value="<?= @$item['id'] ?>" />
                    <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                    <?php if ( $_GET['act'] == 'add_attr' ) { ?> 
                        <input type="button" class="blueB btn-them-thuoc-tinh" value="Thêm thuộc tính">
                    <?php } ?>
                    <a href="index.php?com=product&act=man_attr&product_id=<?php echo $_GET['product_id'] ?><?php if ($_REQUEST['type'] != '') echo '&type=' . $_REQUEST['type']; ?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        
        $(".btn-them-thuoc-tinh").on('click',function(){
            var clone = $("#clone").clone(true,true);
            clone.removeAttr('id').addClass('clone_item');
            clone.find('input').val('');
            $("#container_append").append(clone);
        });
        $("body").on('click','.btn-xoa-thuoc-tinh',function(){
            $(this).parents('.clone_item').remove();
        });
    });
</script>