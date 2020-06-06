<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
	get_items();
	$template = "diachi/item";
	break;
	case "add":
	$template = "diachi/item_add";
	break;
	case "edit":
	get_item();
	$template = "diachi/item_add";
	break;
	case "save":
	save_item();
	break;
	case "delete":
	delete_item();
	break;

	default:
	$template = "index";
}


function get_items(){
	global $d, $items, $paging,$page;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_diachi SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=diachi&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_diachi SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=diachi&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_diachi where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			

			}
			redirect("index.php?com=diachi&act=man");			
		}				
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_diachi where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_diachi SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_diachi SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

		}	
	}

	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = 'ORDER BY stt ASC limit '.$startpoint.','.$per_page;
	$where = " #_diachi ";
	$where .= " where type='".$_GET['type']."' ";
	$sql = "select * from $where $limit";		
	$d->query($sql);
	$items = $d->result_array();
	$url = "index.php?com=baiviet&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item, $ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=diachi&act=man&type=".$_GET['type']."");
	
	$sql = "select * from #_diachi where id='".$id."' and type='".$_GET['type']."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=diachi&act=man&type=".$_GET['type']."");
	$item = $d->fetch_array();
	$ds_photo = _result_array("select * from #_photo where posts_id='".$id."' AND type like '".$_GET['type']."' order by stt,id desc ");
}

function save_item(){
	global $d,$ar_lang;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=diachi&act=man&type=".$_GET['type']."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['diachi_'.$value['slug']] = $_POST['diachi_'.$value['slug']];
		$data['noidung_'.$value['slug']] = magic_quote($_POST['noidung_'.$value['slug']]);
	}	
	$data['link'] = $_POST['link'];	
	$data['dienthoai'] = $_POST['dienthoai'];
	$data['email'] = $_POST['email'];
	$data['latlng'] = ''.$_POST['latlng'].'';
	$data['stt'] = $_POST['num'];
	$data['website'] = $_POST['website'];
	$data['type'] = $_GET['type'];
	$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		$data['ngaysua'] = time();	
		$d->setTable('diachi');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if (isset($_FILES['files'])) {
				for($i=0;$i<count($_FILES['files']['name']);$i++){
					if($_FILES['files']['name'][$i]!=''){
						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
						$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999).$i;
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name);
						$data1['photo_vi'] = $photo;
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['posts_id'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('photo');
						$d->insert($data1);
					}
				}
			}
			header("Location:index.php?com=diachi&act=man&type=".$_GET['type']."");
		} else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=diachi&act=man&type=".$_GET['type']."");
		}
	}else{ // them moi
		if($photo = upload_image("file",'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}
		$data['ngaytao'] = time();
		$data['type'] = $_GET['type'];
		$d->setTable('diachi');
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
						$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999).$i;
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name);
						$data1['photo_vi'] = $photo;
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['posts_id'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('photo');
						$d->insert($data1);
					}
				}
			}
			header("Location:index.php?com=diachi&act=man&type=".$_GET['type']."");
		}
		else{
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=diachi&act=man&type=".$_GET['type']."");
		}
	}
}

function delete_item(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_diachi where id='".$id."' and type='".$_GET['type']."'";
		if($d->query($sql))
			header("Location:index.php?com=diachi&act=man&type=".$_GET['type']."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=diachi&act=man&type=".$_GET['type']."");
	}else transfer("Không nhận được dữ liệu", "index.php?com=diachi&act=man&type=".$_GET['type']."");
}
#--------------------------------------------------------------------------------------------- photo
?>