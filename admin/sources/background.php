<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
	get_gioithieu();
	$template = "background/item_add";
	break;
	case "save":
	save_gioithieu();
	break;
	default:
	$template = "index";
}

function get_gioithieu(){
	global $d, $item;
	$type = $_GET['type'];
	if($_REQUEST['xoaanh']!='')
	{
		$id_up = $_REQUEST['xoaanh'];
		$spdc=time();
		$sql_sp = "SELECT id,photo FROM table_bgweb WHERE type='".$type."'";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$spdc1=$cats[0]['photo'];
		if($spdc1!='')
		{
			$sqlUPDATE_ORDER = "UPDATE table_bgweb SET photo ='' where type='".$type."' ";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			if($resultUPDATE_ORDER){
				redirect($_SESSION['links_re']);
			}
		}
	}
	$sql = "select * from #_bgweb where type='$type' limit 0,1";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d,$title_main;

	$file_name= changeTitle($title_main)."-".rand(0,9999);

	$d->reset();
	$sql = "select * from #_bgweb where type like '".$_GET['type']."' ";	
	$d->query($sql);
	$row_item = $d->result_array();

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=background&act=capnhat&type=".$_GET['type']);
	$type = $_GET['type'];
	
	if(count($row_item)>0){
		if($photo = upload_image("file", _img_type,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('bgweb');
			$d->setWhere('type', $_GET['type']);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		$data['re_peat'] = $_POST['re_peat'];
		$data['tren'] = $_POST['tren'];
		$data['trai'] = $_POST['trai'];
		$data['fix_bg'] = $_POST['fix_bg'];
		$data['mauneen'] = $_POST['mauneen']; 
		$data['type'] = $_GET['type'];
		$data['ngaysua'] = time();
		$d->setTable('bgweb');
		$d->setWhere('type', $type);
		if($d->update($data)){
			redirect($_SESSION['links_re']);
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
		}
	} else {
		if($photo = upload_image("file", _img_type,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}

		$data['re_peat'] = $_POST['re_peat'];
		$data['tren'] = $_POST['tren'];
		$data['trai'] = $_POST['trai'];
		$data['fix_bg'] = $_POST['fix_bg'];
		$data['mauneen'] = $_POST['mauneen']; 
		$data['type'] = $_GET['type'];
		$data['ngaytao'] = time();
		$d->setTable('bgweb');
		if($d->insert($data)){
			redirect($_SESSION['links_re']);
		}
		else{
			transfer($_SESSION['links_re']);
		}
	}
}


?>