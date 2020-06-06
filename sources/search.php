<?php  if(!defined('_source')) die("Error");
$breadcrumb = breadcrumb(array(
	'last' => $title_detail_frq
));
$keywords = mysql_real_escape_string(str_replace(array('"',"'"), '', $_GET['keywords']));
$per_page = 24;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$where = " table_product WHERE ten_vi like '%".$keywords."%' and type like 'bat-dong-san' AND hienthi = 1 ORDER BY stt asc,id DESC"; 
$product = _result_array("SELECT ten_$lang as ten,tenkhongdau,id,photo,giaban,loainha, huong, dien_tich, diachi, ten_lien_lac, dia_chi_lien_lac, dien_thoai_lien_lac, email_lien_lac, ngaytao FROM $where $limit");
$url = getCurrentPageURL();
$paging = pagination($where,$per_page,$page,$url);
$share_result = _fetch_array("SELECT ten_vi as ten,mota,photo,title,keywords,description from table_tieude where type like 'page-info-".$com."'");
if (!empty($share_result)) {
	$title_bar .= $share_result['title'];
	$keywords_bar .= $share_result['keywords'];
	$description_bar .= $share_result['description'];
	$share_facebook = meta_data(array(
		'subject' => 'search',
		'ten' => $share_result['title'],
		'thumbnail' => _upload_hinhanh_l.$share_result['photo'],
		'seo_description' => $share_result['description']
	));
}