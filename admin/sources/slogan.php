<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "slogan/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;
	$sql = "select * from #_slogan limit 0,1";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	$data['ten_sp_vi'] = $_POST['ten_sp_vi'];
	$data['ten_sp_en'] = $_POST['ten_sp_en'];
	$data['ten_gt_vi'] = $_POST['ten_gt_vi'];
	$data['ten_gt_en'] = $_POST['ten_gt_en'];
	$data['ten_album_vi'] = $_POST['ten_album_vi'];
	$data['ten_album_en'] = $_POST['ten_album_en'];
	$d->reset();
	$d->setTable('slogan');
	if($d->update($data)){
		header("Location:index.php?com=slogan&act=capnhat");
	}
	else{
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=slogan&act=capnhat");
	}
}
?>