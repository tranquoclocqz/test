<?php  if(!defined('_source')) die("Error");
$row_detail = _fetch_array("SELECT ten_$lang,noidung_$lang,title_$lang as title,keywords_$lang as keywords,description_$lang as description,photo,ngaytao FROM table_info WHERE type='".$type_bar."' ");
if(empty($row_detail)){
	if(empty($row_detail)){
		include "404.php";
		die;
	}
}
$breadcrumb = breadcrumb(array(
	'last' => $title_detail_frq
));
$title_bar .= $row_detail['title'];
$keywords_bar .= $row_detail['keywords'];
$description_bar .= $row_detail['description'];
$share_facebook = meta_data(array(
	'subject' => 'contact',
	'ten' => $row_detail['title'],
	'thumbnail' => _upload_hinhanh_l.$row_detail['photo'],
	'seo_description' => $row_detail['description']
));
