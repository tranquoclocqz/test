<?php if (!defined('_source')) die("Error");
$slider = _result_array("SELECT link,photo_vi as photo,ten_$lang as ten,id FROM table_photo WHERE type like 'slider' AND hienthi = 1 ORDER BY stt ASC");
$danh_muc_san_pham_index = array_filter($danh_muc_san_pham, function($arr){
	return $arr['noibat'] === "1";
});