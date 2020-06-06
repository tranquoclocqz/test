<?php  if(!defined('_source')) die("Error");
@$id  =  addslashes($_GET['id']);
$row_detail = _fetch_array("SELECT id,ten_$lang as ten FROM table_tags WHERE id='".$id."' ");
$url = getCurrentPageURL();
$per_page = 20;
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$sql_product = "ten_$lang as ten,tenkhongdau,id,photo,noidung_$lang as noidung,giaban,giacu";
$WHERE = " #_product WHERE hienthi=1 AND type='".$type_bar."' and FIND_IN_SET(".$row_detail['id'].",tags)";
$WHERE .= " order by id DESC ";
$product = _result_array("SELECT $sql_product FROM $WHERE $limit");
$paging = pagination($WHERE,$per_page,$page,$url,' ');
$row_detail['ten_'.$lang] = $title_detail_frq;
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
$array_breadcrumb = array(
	'last' => $title_detail_frq
);
$breadcrumb = breadcrumb($array_breadcrumb);
