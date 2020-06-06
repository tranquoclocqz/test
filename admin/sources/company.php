<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
	get_company();
	$template = "company/item_add";
	break;
	case "save":
	save_company();
	break;		
	default:
	$template = "index";
}
if($_GET['type']=='lienhe'){
	$title_main = 'liên Hệ';
}elseif($_GET['type']=='footer'){
	$title_main = 'footer';
}


function get_company(){
	global $d, $item;
	$type = $_GET['type'];

	$sql = "select * from #_company where type='$type' limit 0,1";	
	$d->query($sql);
	$item = $d->fetch_array();
	
}

function save_company(){
	global $d,$ar_lang;
	$file_name=images_name($_FILES['file']['name']);

	$d->reset();
	$sql = "select * from #_company where type='".$_GET['type']."' ";	
	$d->query($sql);
	$row_item = $d->result_array();

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=company&act=capnhat&type=".$_GET['type']);
	$type = $_GET['type'];
	
	
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['noidung_'.$value['slug']] = ($_POST['noidung_'.$value['slug']]);
		$data['mota_'.$value['slug']] = $_POST['mota_'.$value['slug']];
		$data['title_'.$value['slug']] = $_POST['title_'.$value['slug']];
		$data['keywords_'.$value['slug']] = $_POST['keywords_'.$value['slug']];
		$data['description_'.$value['slug']] = $_POST['description_'.$value['slug']];
	}
	$data['stt'] = $_POST['stt'];
	$data['type'] = $type;
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if(count($row_item )>0){
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,1);		
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}
		$d->setTable('company');
		$d->setWhere('type', $type);
		if($d->update($data))
			redirect("index.php?com=company&act=capnhat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=company&act=capnhat&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,1);		
		}		
		$data['ngaytao'] = time();
		$d->setTable('company');
		if($d->insert($data))
		{			
			redirect("index.php?com=company&act=capnhat&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=company&act=capnhat&type=".$_GET['type']);
	}
}
?>