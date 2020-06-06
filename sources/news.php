<?php  if(!defined('_source')) die("Error");
@$idc = addslashes($_GET['idc']);
@$idl = addslashes($_GET['idl']);
@$idi = addslashes($_GET['idi']);
@$ids = addslashes($_GET['ids']);
@$id  = addslashes($_GET['id']);
$url = getCurrentPageURL();
$per_page = $com == 'post' ? 6 : 8;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
if($id!=''){
	$row_detail = _fetch_array("SELECT * FROM table_baiviet WHERE hienthi=1 AND id='".$id."' AND type='".$type_bar."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$id_active = $row_detail['id_list'];
	$title_bar .= $row_detail['title_'.$lang];
	$keywords_bar .= $row_detail['keywords_'.$lang];
	$description_bar .= $row_detail['description_'.$lang];
	$share_facebook .= meta_data(array(
		'subject' => 'news',
		'ten' => $title_bar,
		'thumbnail' => _upload_baiviet_l.$row_detail['photo'],
		'seo_description' =>$description_bar,
	));	
	$condition = $id_active != 0 ? ' and id_list = "'.$id_active.'" ' : '';
	$condition .= $row_detail['id_cat'] != 0 ? ' and id_cat = "'.$row_detail['id_cat'].'" ' : '';
	$tintuc = _result_array("SELECT ten_$lang as ten,ngaytao,id,tenkhongdau,thumb,photo,mota_$lang as mota,file_baogia FROM table_baiviet WHERE hienthi=1 $condition $add $and AND id !='".$row_detail['id']."' AND type='".$type_bar."' order by stt asc,ngaytao desc");
	$hinhanh = _result_array("SELECT photo FROM table_baiviet_photo WHERE id_baiviet = '".$row_detail['id']."' ORDER BY stt ASC");
	$d->query("UPDATE table_baiviet set luotxem = luotxem + 1 WHERE id='".$row_detail['id']."'");
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'last' => $row_detail['ten_'.$lang]
	));
} elseif($idl!=''){
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,photo,thumb,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_list WHERE hienthi=1 $and AND type='".$type_bar."' AND id='".$idl."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$id_active = $row_detail['id'];
	$breadcrumb = breadcrumb(array(
		'first' => array(
			'link' => $com,
			'ten' => $title_detail_frq
		),
		'last' => $row_detail['ten_'.$lang]
	));

	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' AND id_list='".$row_detail['id']."' $and order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,id,thumb,mota_$lang,tenkhongdau,photo,mota_$lang as mota,ngaytao FROM $WHERE $limit");
	
	$paging = pagination($WHERE,$per_page,$page,$url);	
	$title_bar .= $row_detail['title'];
	$keywords_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];

} elseif($idc!='') {
	
	$row_detail = _fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,photo,thumb,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_cat WHERE hienthi=1 AND type='".$type_bar."' $and AND id='".$idc."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$id_active = $row_detail['id_list'];
	$row_detail_list = _fetch_array("SELECT id,ten_$lang,tenkhongdau FROM table_baiviet_list WHERE hienthi=1 AND type='".$type_bar."' AND id='".$row_detail['id_list']."'");
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' AND id_cat='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,ngaytao,id,tenkhongdau,thumb,photo,mota_$lang as mota FROM $WHERE $limit");
	
	$paging = pagination($WHERE,$per_page,$page,$url);
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
				'table' => 'baiviet_list',
				'id' => $row_detail['id_list']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));

} elseif($idi != ''){
	$row_detail = _fetch_array( "SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,title_$lang as title,description_$lang as description,keywords_$lang as keywords FROM table_baiviet_item WHERE hienthi=1 AND type='".$type_bar."' $and AND id='".$idi."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}
	$id_active = $row_detail['id_list'];
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_item='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array( "SELECT ten_$lang as ten,id,thumb,mota_$lang,tenkhongdau,photo,file_baogia,mota_$lang FROM $WHERE $limit");
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
				'table' => 'baiviet_list',
				'id' => $row_detail['id_list']
			),
			array(
				'table' => 'baiviet_cat',
				'id' => $row_detail['id_cat']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));
	
} elseif($ids != ''){
	$row_detail =_fetch_array("SELECT id,ten_$lang,tenkhongdau,id_list,id_cat,id_item,title,keywords,description FROM table_baiviet_sub WHERE hienthi=1 AND  type='".$type_bar."' $and AND id='".$ids."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}

	$id_active = $row_detail['id_list'];
	$WHERE = " #_baiviet WHERE hienthi=1 AND type='".$type_bar."' ".$add." AND id_sub ='".$row_detail['id']."'  order by stt,ngaytao desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,id,thumb,mota_$lang,tenkhongdau,photo,mota_$lang FROM $WHERE $limit");
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
				'table' => 'baiviet_list',
				'id' => $row_detail['id_list']
			),
			array(
				'table' => 'baiviet_cat',
				'id' => $row_detail['id_cat']
			),
			array(
				'table' => 'baiviet_item',
				'id' => $row_detail['id_item']
			),
		),
		'last' => $row_detail['ten_'.$lang]
	));

} else {
	$WHERE = " table_baiviet WHERE hienthi=1 AND type='".$type_bar."' $and order by id desc";
	$tintuc = _result_array("SELECT ten_$lang as ten,photo,thumb,tenkhongdau,mota_$lang as mota,ngaytao,id,luotxem,file_baogia FROM $WHERE $limit");
	$paging = pagination($WHERE,$per_page,$page,$url);
	$breadcrumb = breadcrumb(array(
		'last' => $title_detail_frq
	));
	$share_result = _fetch_array("SELECT ten_vi as ten,mota,photo,title,keywords,description from table_tieude where type like 'page-info-".$com."'");
	$page_du_an = _fetch_array("SELECT noidung_$lang as noidung from table_info where type like 'page-$com'");
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
}