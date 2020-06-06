<?php
$id  =  addslashes($_GET['id']);
$url = getCurrentPageURL();
$per_page = 20;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$sql_product = "ten_$lang as ten,tenkhongdau,id,photo,giaban,giacu";

if($id != ''){
	$row_detail = _fetch_array("SELECT id,ten_$lang as ten,tenkhongdau,title,keywords, description,photo FROM table_nhasanxuat WHERE id='".$id."' AND hienthi=1 AND type='".$type_bar."'");
	if(empty($row_detail)){
		include "404.php";
		die;
	}

	$id_active = $row_detail['id'];
	$WHERE = " table_product WHERE id_nsx='".$row_detail['id']."' and hienthi=1 AND type='".$type_bar."' order by stt asc";
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
		'last' => $row_detail['ten']
	));
} else {
	$thuonghieu = _result_array("SELECT ten_$lang as ten,photo,tenkhongdau from table_nhasanxuat where hienthi = 1 order by stt asc,id desc");
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
		'last' => $row_detail['ten_'.$lang]
	));
}