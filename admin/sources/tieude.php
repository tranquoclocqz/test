<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man":
	get_items();
	$template = "tieude/items";
	break;
	case "add":		
	$template = "tieude/item_add";
	break;
	case "edit":		
	get_item();
	$template = "tieude/item_add";
	break;
	/*case "save":
	save_item();
	break;
*/
	case "save":
	save_item2();
	break;

	case "delete":
	delete_item();
	break;	

	default:
	$template = "index";
}

#====================================

function get_items(){
	global $d, $items, $paging,$page;
	
	
	if($_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_tieude where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_tieude SET noibat =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_tieude SET noibat =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_tieude where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_tieude SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_tieude SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 100; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_tieude ";
	$where .= " where 1=1 ";
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,title,type,photo from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();	
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_item(){
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tieude&act=man&type=".$_GET['type']);	
	$sql = "select * from #_tieude where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tieude&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_item2(){
	global $d;	
	$file_name = changeTitle($_POST['title']).'-'.rand(0,9999);
	$file_name2 = changeTitle($_POST['title']).'_'.rand(0,9999);
	$data['ten_vi'] = mysql_real_escape_string($_POST['ten_vi']);
	$data['mota'] = mysql_real_escape_string($_POST['mota']);
	$data['title'] = mysql_real_escape_string($_POST['title']);
	$data['keywords'] = mysql_real_escape_string($_POST['keywords']);
	$data['description'] = mysql_real_escape_string($_POST['description']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		// update
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$d->setTable('tieude');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
			}
		}	
		if($photo = upload_image("file2", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name2)){
			$data['background'] = $photo;	
			$d->setTable('tieude');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['background']);	
			}
		}	
		$data['type'] = $_GET['type'];
		$data['ngaysua'] = time();
		$data['ngaytao'] = time();
		$d->setTable('tieude');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			header("location: index.php?com=tieude&act=man");
		}
	} else {
		$data['type'] = $_GET['type'];
		// insert
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}	

		if($photo = upload_image("file2", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name2)){
			$data['background'] = $photo;
		}	
		$d->setTable('tieude');
		if ($d->insert($data)) {
			header("location: index.php?com=tieude&act=man");
		}
	}

}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tieude&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['mota'] = mysql_real_escape_string($_POST['mota']);
	$data['page'] = mysql_real_escape_string($_POST['page']);
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 600, 400, _upload_hinhanh,$file_name,1);		
			$d->setTable('tieude');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}


		$data['ten_vi'] = $_POST['ten_vi'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['ten_en'] = $_POST['ten_en'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('tieude');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tieude&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tieude&act=man&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 600, 400, _upload_hinhanh,$file_name,1);			
		}		

		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['type'] = $_GET['type'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('tieude');
		if($d->insert($data))
		{			
			redirect("index.php?com=tieude&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tieude&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_tieude where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);
			}
			$sql = "delete from #_tieude where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=tieude&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tieude&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_tieude where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_hinhanh.$row['photo']);
					delete_file(_upload_hinhanh.$row['thumb']);
				}
				$sql = "delete from #_tieude where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=tieude&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=tieude&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


?>