<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
	get_items();
	$template = "lkweb/items";
	break;
	case "add":
	$template = "lkweb/item_add";
	break;
	case "edit":
	get_item();
	$template = "lkweb/item_add";
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
	global $d, $items, $paging, $page;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_lkweb SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=lkweb&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_lkweb SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=lkweb&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_lkweb where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			

			}
			redirect("index.php?com=lkweb&act=man&type=".$_GET['type']);			
		}				
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_lkweb where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
	//echo "id:". $spdc1;
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_lkweb SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_lkweb SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

		}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " table_lkweb ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['post_id']!='')
	{
		$where.=" and post_id=".$_REQUEST['post_id'];
	}

	$where .=" order by id desc";
	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();	

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	
	$sql = "select * from #_lkweb where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['post_id'] = (int)$_POST['post_id'];	
	if($id){ // cap nhat
		if($photo = upload_image("file", _img_type, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);		
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}

		$id =  themdau($_POST['id']);
		$data['ten'] = $_POST['ten'];		
		$data['url'] = $_POST['url'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['num'];
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('lkweb');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=lkweb&act=man&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	}else{ // them moi
		if($photo = upload_image("file", _img_type, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
		}
		$data['ten'] = $_POST['ten'];		
		$data['url'] = $_POST['url'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['num'];
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();		
		$d->setTable('lkweb');

		if($d->insert($data))
			header("Location:index.php?com=lkweb&act=man&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_lkweb where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=lkweb&act=man&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=lkweb&act=man&type=".$_GET['type']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=lkweb&act=man&type=".$_GET['type']);
}
#--------------------------------------------------------------------------------------------- photo
?>