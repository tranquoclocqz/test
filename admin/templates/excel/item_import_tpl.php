<?php 
$product_list = _result_array("SELECT ten_vi as ten,id FROM table_product_list WHERE type = 'san-pham' ORDER BY stt ASC");
?>
<script>
	$(document).ready(function(e) {
		$('#ok').click(function(){
			$('#load').css({visibility: "visible"});
		});    
  });
</script>
<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="index.php?com=product&amp;act=man_cat"><span>Nhập file excel</span></a></li>
   </ul>
   <div class="clear"></div>
 </div>
</div>
<div class="widget">
  <div class="title">
    <h6>Nhập danh sách sản phẩm từ excel</h6>
  </div>
  <div style="padding:10px;">
    <form name="form1" id="from1" action="index.php?com=excel&act=save_import" method="post" enctype="multipart/form-data" class="nhaplieu">
      <div class="formRow">
        <label>Chọn danh mục </label>
        <div class="formRight">
          <select id="" name="id_list" class="main_select select2 select_danhmuc">
           <option value="">Chọn danh mục sản phẩm</option>
           <?php foreach ($product_list as $key => $value): ?>
             <option value="<?php echo $value['id'] ?>"><?php echo $value['ten'] ?></option>
           <?php endforeach ?>
         </select>
       </div>
       <div class="clear"></div>
     </div>  
     <div class="formRow">
       <label></label>
       <div class="formRight">
         <input type="file" name="linkfile"  size="25" maxlength="255"  /> <strong style="margin-left:20px;">Loại : .xls (Ms.Excel 2003)</strong>
       </div>
       <div class="clear"></div>
     </div>
      <div class="formRow">
       <label></label>
       <div class="formRight">
        <input type="submit" name="ok" id="ok" value="Upload" class="blueB" />
        <div class="clear"></div>
       </div>
     </div>
   </form>
   <div id="load"></div>
   <h3><?=$thongbao?></h3>
 </div>
</div>
