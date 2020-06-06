<style>
    .site_url{
        display: inline-block;
    }
    .slug_name{
        width: 300px;
        display: inline-block;
    }
    .form input[type=text].input_slug_name.tipS{
        background: none;
        box-shadow: none;
        outline: none;
        border: none;
        padding-left: 0;
        padding-right: 0;
    }
    .chk_change_slug .checker{
        margin-top: 2px;
    }
</style>
<div class="formRow">
    <label>Đường dẫn/URI</label>
    <div class="formRight">
        <div class="clearfix">
         <span class="site_url"><?php echo $site_uri =  !define('SITE_URI') ? 'http://'.$config_url : SITE_URI ?>/</span>
         <div class="slug_name">
            <input type="text" name="tenkhongdau" id="tenkhongdau" class="input_slug_name slug tipS validate[required]" value="<?=@$item['tenkhongdau']?>" readonly required />
        </div>
        <div class="chk_change_slug">
            <label><input type="checkbox" name="chk_slug"> Thay đổi đường dẫn</label>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<script>
    $(function(){
        function handleStripUnicode(str){
            str = str.toLowerCase();
            str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
            str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
            str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
            str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
            str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
            str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
            str = str.replace(/(đ)/g, 'd');
            str = str.replace(/([^-_a-zA-Z0-9\ ])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/\-\-\-\-\-/gi, '-');
            str = str.replace(/\-\-\-\-/gi, '-');
            str = str.replace(/\-\-\-/gi, '-');
            str = str.replace(/\-\-/gi, '-');
            str = str.replace(/^-+/g, '');
            str = str.replace(/--+$/g, '-');
            return str;
        }
        var check = false;

        $("input[name='chk_slug']").change(function(event) {
         if ($(this).is(":checked")) {
            check = true;
            $(".slug").removeClass('input_slug_name').removeAttr('readonly');
        } else {
            check = false;
            $(".slug").addClass('input_slug_name');
            $(".slug").attr('readonly','readonly');
        }
    });
        
        $('input.slug').on('keyup', function(event){
            if (check) {
                if( event.keyCode>=37 && event.keyCode<=40 ) return;
                var str = handleStripUnicode($(this).val());
                $(this).val(str);
            }
        });

        $('input[name="ten_vi"]').on('keyup blur', function(){
            if (!check) {
                var str = handleStripUnicode($(this).val());
                $('input.slug').val(str);
            }
        });
    });
</script>