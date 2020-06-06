<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man":
	get_items();
	$template = "dichvukemtheo/items";
	break;
	case "add":		
	$template = "dichvukemtheo/item_add";
	break;
	case "edit":		
	get_item();
	$template = "dichvukemtheo/item_add";
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

#====================================

function get_items(){
	global $d, $items, $paging,$page;
	
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_dichvukemtheo where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_dichvukemtheo SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_dichvukemtheo SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_dichvukemtheo WHERE type like '".$_GET['type']."' ";
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt desc";

	$sql = "select ten_vi,id,stt,hienthi,id from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_item(){
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);	
	$sql = "select * from #_dichvukemtheo where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_item(){
	global $d,$ar_lang;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
	}	
	$data['type'] = $_GET['type'];
	$data['gia'] = str_replace(',','',$_POST['gia']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){
		$data['ngaysua'] = time();
		$d->setTable('dichvukemtheo');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
	}else{
		$data['ngaytao'] = time();
		$d->setTable('dichvukemtheo');
		if($d->insert($data))
		{			
			redirect("index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=dichvukemtheo&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id from #_dichvukemtheo where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_dichvukemtheo.$row['photo']);
				delete_file(_upload_dichvukemtheo.$row['thumb']);
			}
			$sql = "delete from #_dichvukemtheo where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=dichvukemtheo&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=dichvukemtheo&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id from #_dichvukemtheo where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_dichvukemtheo.$row['photo']);
					delete_file(_upload_dichvukemtheo.$row['thumb']);
				}
				$sql = "delete from #_dichvukemtheo where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=dichvukemtheo&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=dichvukemtheo&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


?>