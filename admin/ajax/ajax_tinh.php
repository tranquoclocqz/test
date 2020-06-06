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
	// $result = _result_array("SELECT ten_vi as ten,id FROM {$_POST['table']} WHERE id_list = {$_POST['id']}");
	// $str = '
	// <option value="0">-- Chọn Quận/Huyện --</option>
	// ';
	// foreach ($result as $key => $value) {
	// 	$str .= '
	// 	<option value="'.$value['id'].'">'.$value['ten'].'</option>
	// 	';
	// }
	// echo $str;
			switch ($_POST['level']) {
				case '0':
				$sql = 'SELECT ten_vi as ten,id FROM table_quan WHERE id_list= "'.$_POST['id'].'"';
				$text = '-- Chọn Quận/Huyện --';
				break;
				case '1':
				$sql = 'SELECT ten_vi as ten,id FROM table_phuong WHERE id_cat= "'.$_POST['id'].'"';
				$text = '-- Chọn Phường/Xã --';
				break;
				case '2':
				$sql = 'SELECT ten_vi as ten,id FROM table_duong WHERE id_cat= "'.$_POST['id'].'"';
				$text = '-- Chọn đường --';
				break;
			}

			$result = _result_array($sql);
			$str = '
			<option value="0">'.$text.'</option>
			';
			foreach ($result as $key => $value) {
				$str .= '
				<option value="'.$value['id'].'">'.$value['ten'].'</option>
				';
			}
			echo $str;
		}
	}
}