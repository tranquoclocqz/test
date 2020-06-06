<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
	get_gioithieu();
	$template = "setting/item_add";
	break;
	case "save":
	save_gioithieu();
	break;

	default:
	$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_setting limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d,$ar_lang;
	$file_name=images_name($_FILES['file']['name']);
	$file_name2=images_name($_FILES['watermark']['name']);
	$file_name3=images_name($_FILES['watermark2']['name']);
	$file_name4=images_name($_FILES['screenshot']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=setting&act=capnhat");
	if($photo = upload_image("watermark", 'png|PNG', _upload,'watermark')){
		$data['watermark'] = $photo;
		removeCacheThumb();
	}
	if($photo = upload_image("watermark2", 'png|PNG', _upload,$file_name3)){
		$data['watermark2'] = $photo;
		$watermark_old = _fetch_array("SELECT watermark2 FROM table_setting LIMIT 0,1");
		delete_file(_upload.$watermark_old['watermark2']);	
	}
	if($photo = upload_image("file_bocongthuong", 'jpg|png|gif|JPG|jpeg|JPEG', _upload,$file_name)){
		$data['bocongthuong'] = $photo;
		$watermark_old = _fetch_array("SELECT bocongthuong FROM table_setting LIMIT 0,1");
		delete_file(_upload.$watermark_old['bocongthuong']);	
	}
	if($photo = upload_image("screenshot", 'jpg|png|gif|JPG|jpeg|JPEG|gif|GIF', _upload,$file_name4)){
		$data['screenshot'] = $photo;
		$watermark_old = _fetch_array("SELECT screenshot FROM table_setting LIMIT 0,1");
		delete_file(_upload.$watermark_old['screenshot']);	
	}
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['slogan_'.$value['slug']] = magic_quote($_POST['slogan_'.$value['slug']]);
		$data['diachi_'.$value['slug']] = magic_quote($_POST['diachi_'.$value['slug']]);
		$data['title_'.$value['slug']] = magic_quote($_POST['title_'.$value['slug']]);
		$data['keywords_'.$value['slug']] = magic_quote($_POST['keywords_'.$value['slug']]);
		$data['description_'.$value['slug']] = magic_quote($_POST['description_'.$value['slug']]);
	}	
	$data['thuonghieu'] = $_POST['thuonghieu'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['description_website'] = $_POST['description_website'];
	$data['title_website'] = $_POST['title_website'];
	$data['slogan_vs_vi'] = $_POST['slogan_vs_vi'];
	$data['slogan_lh_vi'] = $_POST['slogan_lh_vi'];
	$data['slogan_en'] = $_POST['slogan_en'];
	$data['zalo'] = $_POST['zalo'];
	$data['link_bocongthuong'] = $_POST['link_bocongthuong'];
	$data['sdtzalo'] = $_POST['sdtzalo'];
	$data['copyright'] = $_POST['copyright'];
	$data['scriptbottom'] = $_POST['scriptbottom'];
	$data['scripttop'] = magic_quote($_POST['scripttop']);	
	$data['meta'] = $_POST['meta'];
	$data['tigia'] = str_replace(',', '', $_POST['tigia']);
	$data['slogan_in_vi'] = $_POST['slogan_in_vi'];	
	$data['slogan_km_vi'] = $_POST['slogan_km_vi'];
	$data['thu2'] = $_POST['thu2'];
	$data['hotlineintro'] = $_POST['hotlineintro'];
	$data['chunhat'] = $_POST['chunhat'];
	$data['tenph'] = $_POST['tenph'];
	$data['dienthoaiph'] = $_POST['dienthoaiph'];
	$data['emailph'] = $_POST['emailph'];
	$data['ngoaigio'] = $_POST['ngoaigio'];
	$data['datve'] = $_POST['datve'];
	$data['dienthoai'] = $_POST['dienthoai'];
	$data['apikey'] = $_POST['apikey'];
	$data['email'] = $_POST['email'];
	$data['website'] = $_POST['website'];
	
	$data['facebook'] = $_POST['facebook'];
	$data['toado'] =''.$_POST['toado'].'';

	$data['facebook2'] = $_POST['facebook2'];
	$data['toado2'] =''.$_POST['toado2'].'';

	$data['hotline'] = $_POST['hotline'];
	
	$data['analytics'] = magic_quote($_POST['analytics']);
	$data['vchat'] = magic_quote($_POST['vchat']);

	$d->reset();
	$d->setTable('setting');
	if($d->update($data))
		header("Location:index.php?com=setting&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=setting&act=capnhat");
}

?>