<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
	get_items();
	$template = "tinhthanh/items";
	break;
	case "add":
	get_list();
	$template = "tinhthanh/item_add";
	break;
	case "edit":
	get_list();
	get_item();
	$template = "tinhthanh/item_add";
	break;
	case "save":
	save_item();
	break;
	case "delete":
	delete_item();
	break;
#--------------------------------------
	case "man_cat":
	get_cats();
	$template = "tinhthanh/cats";
	break;
	case "add_cat":
	$template = "tinhthanh/cat_add";
	break;
	case "edit_cat":
	get_cat();
	$template = "tinhthanh/cat_add";
	break;
	case "save_cat":
	save_cat();
	break;
	case "delete_cat":
	delete_cat();
	break;
#--------------------------------------
	case "man_phuong":
	get_phuongs();
	$template = "tinhthanh/phuong";
	break;
	case "add_phuong":
	$template = "tinhthanh/phuong_add";
	break;
	case "edit_phuong":
	get_phuong();
	$template = "tinhthanh/phuong_add";
	break;
	case "save_phuong":
	save_phuong();
	break;
	case "delete_phuong":
	delete_phuong();
	break;
#--------------------------------------
	case "man_duong":
	get_duongs();
	$template = "tinhthanh/duong";
	break;
	case "add_duong":
	$template = "tinhthanh/duong_add";
	break;
	case "edit_duong":
	get_duong();
	$template = "tinhthanh/duong_add";
	break;
	case "save_duong":
	save_duong();
	break;
	case "delete_duong":
	delete_duong();
	break;
	default:
	$template = "index";
}

#====================================
#====================================
function get_items(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_quan where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_quan SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER);
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_quan SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER);
		}
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_quan ";
	$where .= " where id>0 ";

	if($_REQUEST['ma_tp']!='')
	{
		$where.=" and ma_tp = '".$_REQUEST['ma_tp']."'";
	}

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by ma_tp ASC";
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
		transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man");
	
	$sql = "select * from #_quan where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh&act=man");
	$item = $d->fetch_array();
	get_list($item['id_cat']);
}

function save_item(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		
		$data['ma_tp'] = $_POST['ma_tp'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('quan');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tinhthanh&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man");
	}else{
		
		$data['ma_tp'] = $_POST['ma_tp'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('quan');
		if($d->insert($data))
			redirect("index.php?com=tinhthanh&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man");
	}
}

function delete_item(){
	global $d;

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select * from #_quan where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			
			$sql = "delete from #_quan where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=tinhthanh&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man");
}

#----------------------------------------
function get_cats(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_tinh where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_tinh SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_tinh SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_tinh ";
	$where .= " where id>0 ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt asc";

	$sql = "select * from $where $limit"; 
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);	

}

function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat");
	$sql = "select id,ten_vi as ten,stt,hienthi from #_tinh where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh&act=man_cat");
	$item = $d->fetch_array();
}

function save_cat(){
	global $d;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('tinh');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tinhthanh&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_cat");
	}else{
		$data['ten'] = $_POST['ten'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('tinh');
		if($d->insert($data))
			redirect("index.php?com=tinhthanh&act=man_cat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_cat");
	}
}
function delete_cat(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,ten_vi from #_quan where id_cat='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				$sql = "delete from #_quan where id_cat='".$id."'";
			}
			$d->query($sql);
		}
		$sql = "delete from #_tinh where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=tinhthanh&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_cat");
	}else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_cat");
}
#----------------------------------------
function get_phuongs(){
	global $d, $items, $paging;
	$sql = "select ten,id,stt,hienthi,id_cat,id_quan from #_phuong";
	if($_REQUEST['id_cat']!='')
	{
		$sql.=" where  id_cat=".$_REQUEST['id_cat']."";
	}
	if($_REQUEST['id_quan']!='')
	{
		$sql.=" and  id_quan=".$_REQUEST['id_quan']."";
	}
	$sql.=" order by ten asc";
	$d->query($sql);
	$items = $d->result_array();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tinhthanh&act=man_phuong&id_cat=".$_GET['id_cat'];
	$maxR=30;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_phuong(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_phuong");
	$sql = "select * from #_phuong where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh&act=man_phuong");
	$item = $d->fetch_array();
}

function save_phuong(){
	global $d;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_phuong");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_quan'] = $_POST['id_quan'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('phuong');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tinhthanh&act=man_phuong&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_phuong");
	}else{
		$data['ten'] = $_POST['ten'];
		$data['stt'] = $_POST['stt'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_quan'] = $_POST['id_quan'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('phuong');
		if($d->insert($data))
			redirect("index.php?com=tinhthanh&act=man_phuong");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_phuong");
	}
}
function delete_phuong(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,ten from #_phuong where id_cat='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				$sql = "delete from #_phuong where id_cat='".$id."'";
			}
			$d->query($sql);
		}
		$sql = "delete from #_phuong where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=tinhthanh&act=man_phuong");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_phuong");
	}else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_phuong");
}
#----------------------------------------
function get_duongs(){
	global $d, $items, $paging;
	$sql = "select ten,id,stt,hienthi,id_cat,id_quan,id_phuong from #_duong";
	if($_REQUEST['id_cat']!='')
	{
		$sql.=" where  id_cat=".$_REQUEST['id_cat']."";
	}
	if($_REQUEST['id_quan']!='')
	{
		$sql.=" and  id_quan=".$_REQUEST['id_quan']."";
	}
	if($_REQUEST['id_phuong']!='')
	{
		$sql.=" and  id_phuong=".$_REQUEST['id_phuong']."";
	}
	$sql.=" order by ten asc";
	$d->query($sql);
	$items = $d->result_array();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tinhthanh&act=man_duong&id_cat=".$_GET['id_cat']."&id_quan=".$_GET['id_quan']."&id_phuong=".$_GET['id_phuong'];
	$maxR=50;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_duong(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_duong");
	$sql = "select * from #_duong where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh&act=man_duong");
	$item = $d->fetch_array();
}

function save_duong(){
	global $d;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_duong");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_quan'] = $_POST['id_quan'];
		$data['id_phuong'] = $_POST['id_phuong'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('duong');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tinhthanh&act=man_duong&curPage=".$_REQUEST['curPage']."&id_cat=".$_REQUEST['id_cat']."&id_quan=".$_REQUEST['id_quan']."&id_phuong=".$_REQUEST['id_phuong']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_duong");
	}else{
		$data['ten'] = $_POST['ten'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_quan'] = $_POST['id_quan'];
		$data['id_phuong'] = $_POST['id_phuong'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('duong');
		if($d->insert($data))
			redirect("index.php?com=tinhthanh&act=man_duong");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_duong");
	}
}
function delete_duong(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,ten from #_duong where id_cat='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				$sql = "delete from #_duong where id_cat='".$id."'";
			}
			$d->query($sql);
		}
		$sql = "delete from #_duong where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=tinhthanh&act=man_duong");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh&act=man_duong");
	}else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh&act=man_duong");
}
#=======================================================
function get_list($id=0){
	global $d, $list;
	$sql = "select * from #_tinh order by id desc";
	$d->query($sql);
	$cats = $d->result_array();
	
	$list = '<select name="id_cat" class="input">
	
	<option >Chọn danh mục</option>
	';
	for($i=0, $count=count($cats); $i<$count; $i++)
		$list .= '<option value="'.$cats[$i]['id'].'" '.(($cats[$i]['id']==$id)?'selected="selected"':'').'>'.$cats[$i]['ten'].'</option>';
	$list .= '</select>';
}
#=======================================================
function get_list_quan($id=0){
	global $d, $list;
	$sql = "select * from #_quan where id_cat='".$_GET['id_cat']."' order by id desc";
	$d->query($sql);
	$cats = $d->result_array();
	
	$list = '<select name="id_quan" class="input">
	
	<option >Chọn danh mục</option>
	';
	for($i=0, $count=count($cats); $i<$count; $i++)
		$list .= '<option value="'.$cats[$i]['id'].'" '.(($cats[$i]['id']==$id)?'selected="selected"':'').'>'.$cats[$i]['ten'].'</option>';
	$list .= '</select>';
}
#=======================================================
function get_list_phuong($id=0){
	global $d, $list;
	$sql = "select * from #_phuong where id_quan='".$_GET['id_quan']."' order by id desc";
	$d->query($sql);
	$cats = $d->result_array();
	
	$list = '<select name="id_phuong" class="input">
	
	<option >Chọn danh mục</option>
	';
	for($i=0, $count=count($cats); $i<$count; $i++)
		$list .= '<option value="'.$cats[$i]['id'].'" '.(($cats[$i]['id']==$id)?'selected="selected"':'').'>'.$cats[$i]['ten'].'</option>';
	$list .= '</select>';
}

?>