<?php
session_start();
@define ( '_lib' , '../../libraries/');
include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
if (isAjaxRequest()) {
	$d = new database($config['database']);
	if(check_login()==false){
		die();
	} else {
		if(!empty($_POST)){
			if($_POST['table']=='table_user'){
				die();	
			}
			$id = $_POST['id'];
			if(is_numeric($id) && $id > 0){
				$d->reset();
				$sql="DELETE FROM #_size_theo_gia WHERE id=".$id."";
				if($d->query($sql)){
					$status = 1;
				} else {
					$status = 0;
				}
			}
			echo json_encode(array('status'=>$status));
		}
	}
}
?>