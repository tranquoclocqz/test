
<?php	if(!defined('_source')) die("Error");

switch($act){

	/* lang */

	case 'man_lang':
	man_lang();
	$template = 'option/lang/item';
	break;

	case 'add_lang':
	$template = 'option/lang/item_add';
	break;

	case 'edit_lang':
	edit_lang();
	$template = 'option/lang/item_add';
	break;

	case 'save_lang':
	save_lang();
	break;

	case 'delete_lang':
	delete_lang();
	break;

	/* #lang */

	case 'man':
	man();
	$template = 'option/item';
	break;

	case 'add':
	$template = 'option/item_add';
	break;

	case 'edit':
	edit();
	$template = 'option/item_add';
	break;

	case 'save':
	save();
	break;

	case 'delete':
	delete();
	break;

	case 'title':
	get_title();
	$template = 'option/title';
	break;

	case 'man_cat':
	get_cats();
	$template = 'option/cat/item';
	break;

	case 'add_cat':
	$template = 'option/cat/item_add';
	break;

	case 'save_cat':
	save_cat();
	break;

	case 'edit_cat':
	edit_cat();
	$template = 'option/cat/item_add';
	break;


	case 'delete_cat':
	delete_cat();
	break;

	default:
	$template = "index";
}

/* lang */

function write_lang(){
	global $ar_lang;
	$_result = _result_array("SELECT ten,name,value FROM table_option WHERE type like 'lang'");
	foreach ($ar_lang as $key => $value) {
		$myfile = fopen("../sources/lang_".$value['slug'].".txt", "w") or die("Unable to open file!");
		$ar_l = array();
		foreach ($_result as $key2 => $value2) {
			$ar = json_decode($value2['value'],true);
			$ar_l[] = array('name'=>$value2['name'],'value'=>$ar[$value['slug']]);
		}
		//dump(json_encode($ar_l,JSON_UNESCAPED_UNICODE));
		$txt = json_encode($ar_l,JSON_UNESCAPED_UNICODE);
		fwrite($myfile, $txt);		
		fclose($myfile);
	}
}

function man_lang(){
	global $d,$item,$paging,$page;

	if($_REQUEST['xoa']){
		$sql = "DELETE FROM table_option WHERE id=".$_GET['xoa'];
		if($d->query($sql)){
			redirect('index.php?com=option&act=man_lang&type='.$_GET['type']);
		}
	}

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " table_option WHERE type='".$_GET['type']."' AND id_parent = 0";
	$where .=" order by id desc";
	$item = _result_array("SELECT * FROM $where $limit");
	$url = getCurrentPage();
	$paging = pagination($where,$per_page,$page,$url);		
}

function save_lang(){
	global $d;

	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";	
	
	$ar_v = array();
	foreach ($_POST['value'] as $key => $value) {
		$ar_v[$key] = mysql_real_escape_string($value);
	}

	$data['value'] = json_encode($ar_v,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	$data['name']  = $_POST['name'];
	$data['ten']  = $_POST['ten'];

	$data['stt'] = (int)$_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	if ($id) {
		$data['ngaysua'] = time();
		$d->setTable('option');
		$d->setWhere('id',$id);
		if($d->update($data)){
			write_lang();
			header('Location: index.php?com=option&act=man_lang&type='.$_GET['type']);
		}
	} else {
		$data['ngaytao'] = time();
		$data['ngaysua'] = time();
		$d->setTable('option');
		if($d->insert($data)){
			write_lang();
			header('Location: index.php?com=option&act=man_lang&type='.$_GET['type']);
		}
	}
}

function edit_lang(){
	global $d,$item;
	$item = _fetch_array("SELECT * FROM table_option WHERE id=".$_GET['id']);
}

function delete_lang(){
	global $d;
	$sql ="DELETE FROM table_option WHERE id IN (".$_GET['listid'].")"; 
	if($d->query($sql))	{
		redirect('index.php?com=option&act=man_lang&type='.$_GET['type']);
	}
}

/* #lang */

function delete_cat(){
	global $d;
	$sql = '';
	if (!$_REQUEST['listid']) {
		$d->query("DELETE FROM table_option WHERE id='".$_GET['id']."'");
	} else {
		$ex_id = explode(',', $_GET['listid']);
		foreach ($ex_id as $key => $value) {
			$d->query("DELETE FROM table_option WHERE id='".$value."'");
		}
	}
	redirect('index.php?com=option&act=man_cat&type='.$_GET['type']);
}

function edit_cat(){
	global $d, $item;
	$item = _fetch_array("SELECT ten,id_parent,id,mota,photo FROM table_option WHERE id='".$_GET['id']."'");
}

function get_cats(){
	global $d, $items, $paging,$page;
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_option ";
	$where .= " where type='".$_GET['type']."' AND id_parent != 0 ";	
	if ($_REQUEST['id_list'] != '') {
		$where.=" and id_parent = '".$_REQUEST['id_list']."'";
	}

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten LIKE '%$keyword%'";
	}
	$where .=" order by stt,id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
	
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);

}

function get_title(){
	global $d,$lang,$ar_lang,$item;
	$item = _result_array("SELECT * FROM table_option WHERE type like '".$_GET['type']."'");
}

function delete(){
	global $d;
	$sql ="DELETE FROM table_option WHERE id IN (".$_GET['listid'].")"; 
	if($d->query($sql))	{
		redirect('index.php?com=option&act=man&type='.$_GET['type']);
	}
}

function save_cat(){
	global $d,$item,$paging;
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$file_name=images_name($_FILES['file']['name']);
	$data['id_parent'] = $_POST['id_list'];
	$data['ten'] = changeTitle($_POST['ten']);
	$data['type'] = $_GET['type'];
	$data['stt'] = $_POST['stt'];
	$data['mota'] = $_POST['mota'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

	if ($id) {
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('option');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		$d->setTable('option');
		$d->setWhere('id',$id);
		if($d->update($data)){
			redirect('index.php?com=option&act=man_cat&type='.$_GET['type']);
		}
	} else {
		$data['ngaytao'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}
		$d->setTable('option');
		if ($d->insert($data)) {
			redirect('index.php?com=option&act=man_cat&type='.$_GET['type']);
		}
	}
}

function man(){
	global $d,$item,$paging,$page;

	if($_REQUEST['xoa']){
		$sql = "DELETE FROM table_option WHERE id=".$_GET['xoa'];
		if($d->query($sql)){
			redirect('index.php?com=option&act=man&type='.$_GET['type']);
		}
	}

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " table_option WHERE type='".$_GET['type']."' AND id_parent = 0";
	$where .=" order by stt asc";
	$item = _result_array("SELECT * FROM $where $limit");
	$sql = "SELECT * FROM $where";
	$url = getCurrentPage();
	$paging = pagination($where,$per_page,$page,$url);		
}

function save(){
	global $d,$ar_lang;
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$file_name=images_name($_FILES['file']['name']);
	$data['ten'] = $_POST['ten'];
	$data['tenkhongdau'] = changeTitle($_POST['ten']);
	$data['value'] = $_POST['value'];
	$data['stt'] = (int)$_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	if ($id) {
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('option');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}
		$d->setTable('option');
		$d->setWhere('id',$id);
		if($d->update($data)){
			header('Location: index.php?com=option&act=man&type='.$_GET['type']);
		}
	} else {
		$data['ngaytao'] = time();
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('option');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
			}
		}
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}
		$d->setTable('option');
		if($d->insert($data)){
			header('Location: index.php?com=option&act=man&type='.$_GET['type']);
		}
	}
}

function edit(){
	global $d,$item;
	$item = _fetch_array("SELECT * FROM table_option WHERE id=".$_GET['id']);
}