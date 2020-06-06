<?php
header("Content-type: text/xml");
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './libraries/');
$lang='vi';
include_once _lib . "config.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "file_requick.php";

echo $header_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";

g1("","1.00");
$input = unique_multi_array($arrayCom,'com');
foreach ($input as $key => $value) {
	g1($value['com'],$value['priority']);
}
foreach ($arrayCom as $key => $value) {
	g2($value['table'],$value['type'],$value['priority']);
}
echo "</urlset>";