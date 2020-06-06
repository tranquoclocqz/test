<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man_photo":
	get_photos();
	$template = "photo/photos";
	break;
	case "add_photo":	
	$template = "photo/photo_add";
	break;
	case "edit_photo":
	get_photo();
	$template = "photo/photo_edit";
	break;
	case "save_photo":
	save_photo();
	break;
	case "delete_photo":
	delete_photo();
	break;			
	default:
	$template = "index";
}
function get_photos(){
	global $d, $items, $paging,$page;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,photo_vi as photo from #_photo where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo']);
					}
				}
				$sql = "delete from table_photo where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			

			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}				
	}

	#----------------------------------------------------------------------------------------
	
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_photo where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_photo SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_photo SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	#-------------------------------------------------------------------------------			
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = 'ORDER BY id DESC limit '.$startpoint.','.$per_page;
	$where = " #_photo where ";
	if($_REQUEST['type']!='')
	{
		$where.="  type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc = ".$_GET['id_linhvuc'];
	}
	$sql = "select * from $where $limit";		
	$d->query($sql);
	$items = $d->result_array();	
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);		
}

function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$d->setTable('photo');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$ar_lang, $title_main, $config_mul;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_linhvuc'] = $_POST['id_linhvuc'];
	$data['text_1'] = $_POST['text_1'];
	$data['text_2'] = $_POST['text_2'];
	$data['stt'] = (int)$_POST['stt'];
	$data['link'] = $_POST['link'];	
	$data['mapx'] = replace_sodienthoai($_POST['mapx']);	
	$data['video'] = $_POST['video'];
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['mota_'.$value['slug']] = $_POST['mota_'.$value['slug']];
	}	
	$data['type'] = $_POST['type'];	
	$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
	if($id){
		foreach ($ar_lang as $key => $value) {
			$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
			$file_name2 = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
			if($photo = upload_image("file_".$value['slug']."", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
				$data['photo_'.$value['slug']] = $photo;
				$data['thumb_'.$value['slug']] = create_thumb($data['photo_'.$value['slug']], _width_thumb, _height_thumb , _upload_hinhanh,$file_name,_style_thumb);	
				$d->setTable('photo');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo_'.$value['slug']]);
					delete_file(_upload_hinhanh.$row['thumb_'.$value['slug']]);
				}
			}

			if($photo = upload_image("file2_".$value['slug']."", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name2)){
				$data['photo2_'.$value['slug']] = $photo;
				$data['thumb2_'.$value['slug']] = create_thumb($data['photo2_'.$value['slug']], _width_thumb, _height_thumb , _upload_hinhanh,$file_name2,_style_thumb);	
				$d->setTable('photo');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo2_'.$value['slug']]);
					delete_file(_upload_hinhanh.$row['thumb2_'.$value['slug']]);
				}
			}		
		}
		$d->reset();
		$d->setTable('photo');
		$d->setWhere('id', $id);		
		if(!$d->update($data)) {
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		} else {
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		}	
	}else{ 	
		foreach ($ar_lang as $key => $value) {
			$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
			if($photo = upload_image("file_".$value['slug'], 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
				$data['photo_'.$value['slug']] = $photo;
				$data['thumb_'.$value['slug']] = create_thumb($data['photo_'.$value['slug']], _width_thumb, _height_thumb , _upload_hinhanh,$file_name,_style_thumb);	
			}	
			$file_name2 = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
			if($photo = upload_image("file2_".$value['slug'], 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name2)){
				$data['photo2_'.$value['slug']] = $photo;
				$data['thumb2_'.$value['slug']] = create_thumb($data['photo2_'.$value['slug']], _width_thumb, _height_thumb , _upload_hinhanh,$file_name2,_style_thumb);	
			}		
		}
		if (isset($_FILES['files'])) {
			$n = count($_FILES['files']['name']);
			for($i=0;$i<$n;$i++){
				if($_FILES['files']['name'][$i]!=''){
					$file['name'] = $_FILES['files']['name'][$i];
					$file['type'] = $_FILES['files']['type'][$i];
					$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$file['error'] = $_FILES['files']['error'][$i];
					$file['size'] = $_FILES['files']['size'][$i];
					$file_name_multiple = !empty($_POST['ten'][$i]) ? changeTitle($_POST['ten'][$i]).'-'.rand(0,9999) : changeTitle($title_main).'-'.rand(0,9999)  ;
					$photo = upload_photos($file, _img_type, _upload_hinhanh,$file_name_multiple);
					$data1['photo_vi'] = $photo;
					$data1['stt'] = (int)$_POST['stthinh'][$i];
					$data1['ten_vi'] = $_POST['ten_vi'][$i];
					$data1['link'] = $_POST['link'][$i];
					$data1['ten_en'] = !empty($_POST['ten_en'][$i]) ? $_POST['ten_en'][$i] : $_POST['ten_vi'][$i];
					$data1['type'] = $_GET['type'];	
					$data1['hienthi'] = 1;
					$data1['ngaytao'] = time();
					$d->setTable('photo');
					$d->insert($data1);
				}
			}
		}
		if (!$config_mul) {
			$data['ngaytao'] = time();
			$d->reset();
			$d->setTable('photo');
			if($d->insert($data)){
				redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
			} else {
				transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);	
			} 
		} else {
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		}
	}
}


function delete_photo(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo_vi']);
		delete_file(_upload_hinhanh.$row['thumb_vi']);
		if($d->delete())
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
}
?>	