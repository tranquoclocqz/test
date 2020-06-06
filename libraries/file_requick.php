<?php 
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$arrayCom = array(
	array('com' =>'gioi-thieu','table'=>'info','id'=>'id','type'=>'gioi-thieu','priority'=>'0.80'),
	array('com' =>'bat-dong-san','table'=>'product','id'=>'id','type'=>'bat-dong-san','priority'=>'0.80'),
	array('com' =>'bat-dong-san','table'=>'product_cat','id'=>'idc','type'=>'bat-dong-san','priority'=>'0.80'),
	array('com' =>'bat-dong-san','table'=>'product_list','id'=>'idl','type'=>'bat-dong-san','priority'=>'0.80'),
	array('com' =>'tin-tuc','table'=>'baiviet','id'=>'id','type'=>'tin-tuc','priority'=>'0.80'),
	array('com' =>'khung-gia-dat','table'=>'baiviet','id'=>'id','type'=>'khung-gia-dat','priority'=>'0.80'),
	array('com' =>'tu-van-thiet-ke','table'=>'baiviet','id'=>'id','type'=>'tu-van-thiet-ke','priority'=>'0.80'),
	array('com' =>'ky-gui','table'=>'baiviet','id'=>'id','type'=>'ky-gui','priority'=>'0.80'),
	array('com' =>'dich-vu','table'=>'baiviet','id'=>'id','type'=>'dich-vu','priority'=>'0.80'),

);
foreach ($arrayCom as $key => $value) {
	$_result = _fetch_array("SELECT id,type from table_".$value['table']." where tenkhongdau like '".$com."' and tenkhongdau != '' and type like '".$value['type']."'");
	if (!empty($_result)) {
		$_GET[$value['id']] = $_result['id'];
		$com = $value['com'];
		break;
	}
}
switch($com){
	case 'bat-dong-san':
	$template = (isset($_GET['id']) != '') ? 'product_detail' : 'product';
	$source = 'product';
	$type_bar = $com;
	$title_detail_frq = 'Bất động sản';
	break;

	case 'gioi-thieu':
	$template = 'about_detail';
	$source = 'about';
	$type_bar = $com;
	$title_detail_frq = _gioithieu;
	break;

	case 'dich-vu':
	$template = (isset($_GET['id']) != '') ? 'news_detail' : 'news';
	$source = 'news';
	$type_bar = $com;
	$title_detail_frq = 'Dịch vụ';
	break;

	case 'khung-gia-dat':
	$template = (isset($_GET['id']) != '') ? 'news_detail' : 'news';
	$source = 'news';
	$type_bar = $com;
	$title_detail_frq = 'Khung giá đất';
	break;

	case 'tu-van-thiet-ke':
	$template = (isset($_GET['id']) != '') ? 'news_detail' : 'news';
	$source = 'news';
	$type_bar = $com;
	$title_detail_frq = 'Tư vấn thiết kế';
	break;

	case 'ky-gui':
	$template = (isset($_GET['id']) != '') ? 'news_detail' : 'news';
	$source = 'news';
	$type_bar = $com;
	$title_detail_frq = 'Ký gửi';
	break;

	case 'tin-tuc':
	$template = (isset($_GET['id']) != '') ? 'news_detail' : 'news';
	$source = 'news';
	$type_bar = 'tin-tuc';
	$title_detail_frq = 'Tin tức sự kiện';
	break;

	case 'lien-he':
	$template = 'contact';
	$source = 'contact';
	$type_bar = 'lien-he';
	$title_detail_frq = _lienhe;
	break;

	case 'tim-kiem':
	$template = 'search';
	$source = 'search';
	$title_detail_frq = _timkiem;
	break;

	case '';case 'trang-chu';case 'home';case 'default'; case 'index':
	$source = "index";
	$template = "index";
	break;

	default: 
	include "404.php";
	die;
	break; 
}
if($source!="") include _source.$source.".php";