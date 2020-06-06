<?php	if(!defined('_source')) die("Error");
switch($act){

	
	case "man":
	get_mans();
	$template = "tags/items";
	break;
	case "add":		
	$template = "tags/item_add";
	break;
	case "edit":		
	get_man();
	$template = "tags/item_add";
	break;
	case "save":
	save_man();
	break;

	case "delete":
	delete_man();
	break;	
	#============================================================

	default:
	$template = "index";
}

#====================================

function get_mans(){
	global $d, $items, $paging,$page;
	
	#----------------------------------------------------------------------------------------
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_tags ";
	$where .= " where id<>0 AND type like '".$_GET['type']."'";

	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=tags&act=man&type=".$_GET['type']."".$link_add."&type=".$_GET['type'];
	$paging = pagination($where,$per_page,$page,$url);		
	$paging = $paging["pagination"];	
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tags&act=man&type=".$_GET['type']);	
	$sql = "select * from #_tags where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tags&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	

}

function save_man(){
	global $d,$ar_lang;

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tags&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
	$data['link'] = $_POST['link'];
	$data['stt'] = $_POST['stt'];
	$data['type'] = $_GET['type'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['ngaysua'] = time();
	if($id){
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
			$d->setTable('tags');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		$d->setTable('tags');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=tags&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tags&act=man&type=".$_GET['type']);
	}else{
		$data['ngaytao'] = time();
		if($photo = upload_image("file", _img_type, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
		}
		$d->setTable('tags');
		if($d->insert($data))
		{			
			redirect("index.php?com=tags&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tags&act=man&type=".$_GET['type']);
	}
}

function delete_man(){
	global $d;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		$sql = "delete from #_tags where id='".$id."'";
		$d->query($sql);
		
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$sql = "delete from #_tags where id='".$id."'";
			$d->query($sql);
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}


}




?>