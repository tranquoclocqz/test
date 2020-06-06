<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
	get_banner();
	$template = "audio/audio";
	break;
	case "save":
	save_banner();
	break;
	#====================================
	
	default:
	$template = "index";
}


function get_banner(){
	global $d, $item;

	$sql = "select * from #_photo where type='".$_GET['type']."'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d;

	$sql = "select * from #_photo where type='".$_GET['type']."'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];
	if($photo = upload_image("file_vi", _img_type, _upload_hinhanh,images_name($_FILES['file_vi']['name']))){
		$data['photo_vi'] = $photo;
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('type',$_GET['type']);
		$d->select();
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo_vi']);
	}
	$data['ten_vi'] = $_POST['ten_vi'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){ 
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('type',$_GET['type']);
		if($d->update($data))
			redirect("index.php?com=audio&act=capnhat&type=".$_GET['type']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=audio&act=capnhat&type=".$_GET['type']."");
	}else{
		if($photo = upload_image("file_vi", _img_type, _upload_hinhanh,images_name($_FILES['file_vi']['name']))){
			$data['photo_vi'] = $photo;
		}
		$d->setTable('photo');
		if($d->insert($data))
			redirect("index.php?com=audio&act=capnhat&type=".$_GET['type']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=audio&act=capnhat&type=".$_GET['type']."");
	}
}
?>