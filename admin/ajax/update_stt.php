<?php
session_start();
@define ( '_lib' , '../../libraries/');

include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."library.php";
include_once _lib."class.database.php";	
include_once _lib."pclzip.php";
if (isAjaxRequest()) {
	$d = new database($config['database']);
	if(check_login()==false){
		die();
	} else {
		if(!empty($_POST)){
			if($_POST['table']=='table_user'){
				die();	
			}
			$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
			$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
			

			$table = $_POST['table'];
			$id = $_POST['id'];
			$value = $_POST['value'];

			$data['stt'] = $value;
			$d->setTable($table);
			$d->setWhere('id', $id);
			$d->update($data);
		}
	}
}
?>

