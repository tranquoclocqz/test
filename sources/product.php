<?php  if(!defined('_source')) die("Error");
@$idc =  addslashes($_GET['idc']);
@$idl =  addslashes($_GET['idl']);
@$idi =  addslashes($_GET['idi']);
@$ids =  addslashes($_GET['ids']);
@$id  =  addslashes($_GET['id']);
$url = getCurrentPageURL();
$per_page = 24;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$sql_product = "ten_$lang as ten,tenkhongdau,id,photo,giaban,loainha, huong, dien_tich, diachi, ten_lien_lac, dia_chi_lien_lac, dien_thoai_lien_lac, email_lien_lac, ngaytao";
if($id!=''){
	$row_detail = _fetch_array("SELECT * FROM table_product WHERE hienthi=1 AND type='".$type_bar."' AND id ='".$id."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$id_active = $row_detail['id_list'];
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$share_facebook = meta_data(array(
		'thumbnail' => _upload_product_l.$row_detail['photo'],
		'subject' => 'product',
		'ten' => $title_bar,
		'seo_description' => $description_bar
	));
	$d->query("UPDATE table_product set luotxem = luotxem + 1 where id = '".$row_detail['id']."'");
	$hinhanh_san_pham = _result_array("SELECT photo FROM table_product_photo WHERE id_product='".$row_detail['id']."' order by stt asc,id desc");
	$product = _fetch_array("SELECT count(id) as number FROM table_product WHERE id_list='".$row_detail['id_list']."' and hienthi=1 AND type like '".$type_bar."' AND id!='".$row_detail['id']."'");
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'item' => array(
			array(
				'table' => 'product_list',
				'id' => $row_detail['id_list'],
			),
			array(
				'table' => 'product_cat',
				'id' => $row_detail['id_cat'],
			)
		),
		'last' => $row_detail['ten_'.$lang]
	));
} elseif($idl!=''){
	$row_detail = _fetch_array("SELECT id,id as id_list,ten_$lang,tenkhongdau,title_$lang as title,keywords_$lang as keywords,description_$lang as description,quangcao,photo FROM table_product_list WHERE id='".$idl."' AND hienthi=1 AND type='".$type_bar."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}

	$id_active = $row_detail['id'];
	$WHERE = " table_product WHERE id_list='".$row_detail['id']."' and hienthi=1 AND type='".$type_bar."' order by stt asc";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");	
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'last' => $row_detail['ten_'.$lang]
	));
} elseif($idc!=''){
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,title_$lang as title,keywords_$lang as keywords,description_$lang as description,photo,noidung_$lang as noidung FROM table_product_cat WHERE hienthi=1 AND id='".$idc."'");	
	if(empty($row_detail)){
		header('location:'.$url_web."/404.php");
	}
	$WHERE = " table_product WHERE id_cat='".$row_detail['id']."' and hienthi=1 AND type='".$type_bar."'  order by stt asc,ngaytao desc";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$id_active = $row_detail['id_list'];
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'item' => array(
			array(
				'table' => 'product_list',
				'id' => $row_detail['id_list']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));
} elseif($idi!=''){
	$row_detail = _fetch_array( "SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title_$lang as title,keywords_$lang as keywords,description_$lang as description,photo FROM table_product_item WHERE id='".$idi."' and hienthi=1 AND type='".$type_bar."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}

	$id_active = $row_detail['id_list'];
	$photo_breadcrumb = _upload_product_l.$row_detail['photo'];
	$id_p_l = $row_detail['id_list'];
	$WHERE = " table_product WHERE id_item='".$row_detail['id']."' and hienthi=1 AND type='".$type_bar."'  order by stt asc,ngaytao desc";
	$product = _result_array( "SELECT $sql_product FROM $WHERE $limit");
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'item' => array(
			array(
				'table' => 'product_list',
				'id' => $row_detail['id_list']
			),
			array(
				'table' => 'product_cat',
				'id' => $row_detail['id_cat']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));
}  elseif($ids!=''){
	$row_detail =_fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,id_item,title_$lang as title,keywords_$lang as keywords,description_$lang as description FROM table_product_sub WHERE id='".$ids."' and hienthi=1 AND type='".$type_bar."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$WHERE = " #_product WHERE id_sub='".$row_detail['id']."' and hienthi=1 AND type='".$type_bar."'  order by stt asc,ngaytao desc";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$title_detail = $row_detail['ten_'.$lang];
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'item' => array(
			array(
				'table' => 'product_list',
				'id' => $row_detail['id_list']
			),
			array(
				'table' => 'product_cat',
				'id' => $row_detail['id_cat']
			),
			array(
				'table' => 'product_item',
				'id' => $row_detail['id_item']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));
} else {
	$WHERE = " #_product WHERE type='".$type_bar."' $condition_khuyen_mai and hienthi=1";
	$WHERE .= " order by id DESC ";
	$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
	$paging = pagination($WHERE,$per_page,$page,$url,' ');
	$row_detail['ten_'.$lang] = $title_detail_frq;
	$share_result = _fetch_array("SELECT ten_vi as ten,mota,photo,title,keywords,description from table_tieude where type like 'page-info-".$com."'");
	if (!empty($share_result)) {
		$title_bar .= $share_result['title'];
		$keywords_bar .= $share_result['keywords'];
		$description_bar .= $share_result['description'];
		$share_facebook = meta_data(array(
			'subject' => 'news',
			'ten' => $share_result['title'],
			'thumbnail' => _upload_hinhanh_l.$share_result['photo'],
			'seo_description' => $share_result['description']
		));		
	}
	$breadcrumb = breadcrumb(array(
		'last' => $title_detail_frq
	));
}