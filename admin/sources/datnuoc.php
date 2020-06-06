<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
	get_cats();
	$template = "datnuoc/items";
	break;
	case "add":
	$template = "datnuoc/item_add";
	break;
	case "edit":
	get_cat();
	$template = "datnuoc/item_add";
	break;
	case "save":
	save_cat();
	break;
	case "delete":
	delete_cat();
	break;
}
function get_cats(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_datnuoc where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_datnuoc SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_datnuoc SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_datnuoc ";
	$where .= " where id>0 ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten LIKE '%$keyword%'";
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
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man");
	$sql = "select id,ten as ten,stt,hienthi from #_datnuoc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=datnuoc&act=man");
	$item = $d->fetch_array();
}

function save_cat(){
	global $d;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=datnuoc&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('datnuoc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=datnuoc&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=datnuoc&act=man");
	}else{
		$data['ten'] = $_POST['ten'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('datnuoc');
		if($d->insert($data))
			redirect("index.php?com=datnuoc&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=datnuoc&act=man");
	}
}
function delete_cat(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_datnuoc where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=datnuoc&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=datnuoc&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=datnuoc&act=man");
}