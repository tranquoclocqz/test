<?php
session_start();

@define ( '_lib' , '../libraries/');
@define ( '_source' , '../sources/');
include_once _lib."config.php";
include_once _lib."class.database.php";
$d = new database($config['database']);
include_once _lib."constant.php";
include_once _source . "lang_".$lang.".php";
include_once _lib."functions.php";
include_once _source."lang_$lang.php";
include_once _lib."file_requick.php";
include_once _lib."ajax_paging.php";
if (isAjaxRequest()) {
	if(isset($_POST["page"])){
		$paging = new paging_ajax($d);
		$paging->class_pagination = "pagination pagination2";
		$paging->class_active = "active";
		$paging->class_inactive = "prev";
		$paging->class_next = "next";
		$paging->class_prev= "prev";
		$paging->class_first= "first";
		$paging->class_last= "last";
		$paging->class_go_button = "go_button";
		$paging->class_text_total = "total";
		$paging->class_txt_goto = "txt_go_button";
		$paging->show_goto = false;
		$paging->show_total = false;
		$paging->per_page = 12; 	
		$paging->page = $_POST["page"];
		$paging->text_first = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$paging->text_last = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$paging->text_next = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		$paging->text_prev = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
		$paging->k = $_POST['id'];		
		$paging->text_sql = "SELECT ten_$lang as ten,tenkhongdau,id,photo,giaban,loainha, huong, dien_tich, diachi, ten_lien_lac, dia_chi_lien_lac, dien_thoai_lien_lac, email_lien_lac, ngaytao FROM table_product as product WHERE type like 'bat-dong-san' and hienthi = 1 AND product.id <> '".$_POST['id']."' ORDER BY product.id DESC";
		$result_pag_data = $paging->GetResult();
		$data = $d->result_array($result_pag_data);
		$paging->data = "" . $message . "";
		$i = 0;
	}
	?>
	<div class="grid grid-product">
		<?php foreach ($data as $key => $value): ?>
			<?php echo sanpham($value) ?>
		<?php endforeach ?>
	</div>
	<div class="text-center">
		<?php echo $paging->Load()?>
	</div>
	<?php } ?>