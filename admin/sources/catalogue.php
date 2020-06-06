<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
	man();
	$template = "catalogue/item_add";
	break;
	case "save":
	save();
	break;		
	default:
	$template = "index";
}
function man(){
	global $d, $item,$ds_photo;
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);	
	$ds_photo = _result_array("SELECT * FROM table_photo WHERE type='".$_GET['type']."'");	
}

function save(){
	
}
?>	