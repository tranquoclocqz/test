<?php 
session_start();
@define ( '_lib' , '../../libraries/');
include_once _lib."config.php";
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
			if(isset($_POST["id"]) ){
				echo $sql = "update ".$_POST["bang"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";
				$data = $d->query($sql) or die("Not query sql");
			}
		}
	}
}
?>