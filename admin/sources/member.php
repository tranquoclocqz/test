<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){	

	case "man":
	get_items();
	$template = "member/items";
	break;
	case "add":
	$template = "member/item_add";
	break;
	case "edit":
	get_item();
	$template = "member/item_add";
	break;
	case "save":
	save_item();
	break;
	case "delete":
	delete_item();
	break;
	case "delete_img":
	delete_photo();
	break;	
	
	default:
	$template = "index";
}

//////////////////
function get_items(){
	global $d, $items, $paging,$page;
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET active =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=member&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_member SET active =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=member&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql = "delete from table_member where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			
			}
			redirect("index.php?com=member&act=man");			
		}
	}
	if($_REQUEST['active']!='')
	{
		$id_up = $_REQUEST['active'];
		$sql_sp = "SELECT id,active FROM table_member where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['active'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_member SET active =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			redirect("index.php?com=member&act=man");			
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_member SET active =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			redirect("index.php?com=member&act=man");			
		}	
	}
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" where username LIKE '%$keyword%'";
	}
	
	
	$sql="SELECT count(id) AS numrows FROM #_member $where";
	$d->query($sql);	
	$where .=" #_member order by id desc";
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
		transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
	
	$sql = "select * from #_member where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=member&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,15);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		$sql = "select * from #_member where id='$id'";
		$d->query($sql);		
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['id'] == 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=member&act=man");
		}	

		if($photo = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_member,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('member');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_member.$row['photo']);
			}
		}		
		$data['username'] = $_POST['username'];
		if($_POST['password'] != ''){
			$data['password'] = md5($_POST['password']);
		}
		
		$data['email'] = $_POST['email'];
		$data['username'] = $_POST['username'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$d->reset();
		$d->setTable('member');
		$d->setWhere('id', $id);		
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=member&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=member&act=man");
	}else{
		$s = _fetch_array("SELECT count(id) as num FROM table_member WHERE username like '".$_POST['username']."'");
		if($s['num'] > 0){
			transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=member&act=add");
		}
		$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['sex'] = $_POST['sex'];
		$data['diachi'] = $_POST['diachi'];
		$data['tichluy'] = $_POST['tichluy'];
		$data['randomkey'] = ChuoiNgauNhien(32);
		$d->setTable('member');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=member&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=member&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$sql = "select * from #_member where id='$id'";
		$d->query($sql);		
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['id'] == 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=member&act=man");
		}		
		// xoa item
		$sql = "delete from #_member where id='".$id."'";
		if($d->query($sql))
			transfer("Xóa thành viên thành công", "index.php?com=member&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=member&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=member&act=man");
}
function delete_photo(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id, photo from #_member where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_member.$row['photo']);	
			}
			$sql = "UPDATE #_member SET photo ='' WHERE  id = '".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=member&act=edit&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=member&act=edit&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=member&act=edit&id=".$id);
}

?>