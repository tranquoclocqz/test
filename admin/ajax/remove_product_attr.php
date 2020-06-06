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
			$d->reset();
			$d->setTable('product_attributes');
			$d->setWhere('id',(int)$_POST['id']);
			$d->delete();
		}
	}
}