<?php  if(!defined('_source')) die("Error");
$breadcrumb = breadcrumb(array(
	'last' => $title_detail_frq
));
$hinhanh = _result_array("SELECT photo_vi as photo,link,ten_$lang as ten FROM table_photo WHERE type like '".$type_bar."'");
$share_result = _fetch_array("SELECT ten_vi as ten,mota,photo,title,keywords,description from table_tieude where type like 'page-info-".$com."'");
if (!empty($share_result)) {
	$title_bar .= $share_result['title'];
	$keywords_bar .= $share_result['keywords'];
	$description_bar .= $share_result['description'];
	$meta_data = array(
		'subject' => 'news',
		'ten' => $share_result['title'],
		'thumbnail' => _upload_hinhanh_l.$share_result['photo'],
		'seo_description' => $share_result['description']
	);
	$share_facebook = meta_data($meta_data);
}