<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
	get_info();
	$template = "info/item_add";
	break;
	case "save":
	save_info();
	break;		
	default:
	$template = "index";
}


function get_info(){
	global $d, $item,$ds_photo;
	$type = $_GET['type'];

	$sql = "select * from #_info where type='$type' limit 0,1";	
	$d->query($sql);
	$item = $d->fetch_array();
	$ds_photo= _result_array("select * from #_baiviet_photo where id_info='".$item['id']."' and type='".$_GET['type']."' order by stt desc ");
}

function save_info(){
	global $d,$ar_lang;
	$file_name 	= changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
	$file_name2 = changeTitle($_POST['ten_vi']).'_2-'.rand(0,9999);
	$d->reset();
	$sql = "select id from table_info where type like '".$_GET['type']."'";	
	$d->query($sql);
	$row_item = $d->fetch_array();
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=info&act=capnhat&type=".$_GET['type']);
	$type = $_GET['type'];	
	$data['tenkhongdau'] = ($_POST['tenkhongdau']);
	foreach ($ar_lang as $key => $value) {
		$ar = array();
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['name_'.$value['slug']] = $_POST['name_'.$value['slug']];
		$data['name2_'.$value['slug']] = $_POST['name2_'.$value['slug']];
		$data['noidung_'.$value['slug']] = magic_quote($_POST['noidung_'.$value['slug']]);
		$data['mota_'.$value['slug']] = ($_POST['mota_'.$value['slug']]);
		$data['title_'.$value['slug']] = $_POST['title_'.$value['slug']];
		$data['keywords_'.$value['slug']] = $_POST['keywords_'.$value['slug']];
		$data['description_'.$value['slug']] = $_POST['description_'.$value['slug']];
	}
	$data['links'] = $_POST['links'];
	
	$data['stt'] = $_POST['stt'];		
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;	
	$data['type'] = $_GET['type'];
	if(!empty($row_item)){
		if($photo = upload_image("file_baogia", 'PDF|pdf', _upload_files,$file_name2)){
			$data['file_baogia'] = $photo;	
			$d->setTable('info');
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_files.$row['file_baogia']);	
			}
		}
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);		
			$d->setTable('info');
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}	
		$data['ngaysua'] = time();
		$d->setTable('info');
		$d->setWhere('type', $type);
		if($d->update($data)){
			if (isset($_FILES['files'])) {
				for($i=0;$i<count($_FILES['files']['name']);$i++){
					if($_FILES['files']['name'][$i]!=''){
						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
						$file_name = changeTitle($_POST['ten_vi']).'-attchment-'.rand(0,9999);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_info'] = $row_item['id'];
						$data1['hienthi'] = 1;
						$data1['ngaytao'] = time() + $i;
						$data1['ngaysua'] = time() + $i;
						$d->setTable('baiviet_photo');
						$d->insert($data1);
					}
				}
			}
			redirect("index.php?com=info&act=capnhat&type=".$_GET['type']);
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=info&act=capnhat&type=".$_GET['type']);
		}
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);
		}
		if($photo = upload_image("file_baogia", 'pdf|PDF', _upload_files,$file_name2)){
			$data['file_baogia'] = $photo;		
		}		
		$data['ngaytao'] = time();
		$d->setTable('info');
		if($d->insert($data)){			
			$id = mysql_insert_id();
			if (isset($_FILES['files'])) {
				for($i=0;$i<count($_FILES['files']['name']);$i++){
					if($_FILES['files']['name'][$i]!=''){
						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
						$file_name = changeTitle($_POST['ten_vi']).'-attchment-'.rand(0,9999);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_info'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('baiviet_photo');
						$d->insert($data1);
					}
				}
			}
			redirect("index.php?com=info&act=capnhat&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=info&act=capnhat&type=".$_GET['type']);
	}
}
