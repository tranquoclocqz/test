<?php if (!defined('_lib')) die("Error");

function get_thuonghieu($id){
	return _fetch_array("SELECT ten_vi as ten,id,tenkhongdau from table_nhasanxuat where id = '".$id."'");
}

if (!function_exists('get_options')) {
	function get_options($type)
	{
		return _result_array("SELECT ten,id,value from table_option where type like '$type' and hienthi = 1 order by stt asc,id desc");
	}
}

if (!function_exists('get_option')) {
	function get_option($id)
	{
		return _fetch_array("SELECT ten,id,value from table_option where id like '$id'");
	}
}

function removeCacheThumb()
{
	$dir = '../@#cache/';
	$leave_files = array('.htaccess', 'index.html');
	if (is_dir($dir)) {
		if ($handle = opendir($dir)) {
			while (($file = readdir($handle)) !== false) {
				if (!in_array(basename($file), $leave_files)) {
					unlink($dir . $file);
				}
			}
			closedir($handle);
		}
	}
}

function getRealIPAddress()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function unzip_chuanhoa($s)
{
	$s = str_replace('&#039;', "'", $s);
	$s = str_replace('&quot;', '"', $s);
	$s = str_replace('&lt;', '<', $s);
	$s = str_replace('&gt;', '>', $s);
	return $s;
}
function unique_multi_array($array, $key)
{
	$temp_array = array();
	$i = 0;
	$key_array = array();

	foreach ($array as $val) {
		if (!in_array($val[$key], $key_array)) {
			$key_array[$i] = $val[$key];
			$temp_array[$i] = $val;
		}
		$i++;
	}
	return $temp_array;
}

function unset_multi_array($array = array(), $key, $val)
{
	foreach ($array as $k => $v) {
		if (in_array($v[$key], $val)) {
			unset($array[$k]);
		}
	}
	return (array) $array;
}

function g1($a = "", $b = "1.00")
{
	echo ("<url><loc>" . SITE_URI . "/" . $a . "</loc><lastmod>" . date('c') . "</lastmod><priority>" . $b . "</priority></url>");
}
function g2($table = "baiviet", $type = '', $priority = '')
{
	$result = _result_array("SELECT ngaytao,tenkhongdau,id,type from table_{$table} where type like '{$type}'");
	foreach ($result as $key => $value) {
		echo ("<url><loc>" . SITE_URI . "/" . $value['tenkhongdau'] . "</loc><lastmod>" . date('c', $value['ngaytao']) . "</lastmod><priority>$priority</priority></url>");
	}
}

function fnc_sendMail($config_send_mail = array(), $body)
{
	ini_set("memory_limit", "1024M");
	ini_set("display_errors", 0);
	include_once "phpMailer/class.phpmailer.php";
	$mail = new PHPMailer(true);
	$mail->IsSMTP(); // Gọi đến class xử lý SMTP
	$mail->SMTPDebug  = 1;

	$mail->Host       = $config_send_mail['config_ip'];
	$mail->SMTPAuth   = true;
	$mail->Username   = $config_send_mail['config_email'];
	$mail->Password   = $config_send_mail['config_pass'];


	$mail->SetFrom($config_send_mail['setfrom']['email'], $config_send_mail['setfrom']['title']);
	foreach ($config_send_mail['addAddress'] as $key => $value) {
		$mail->AddAddress($value['email'], $value['title']);
	}
	/* Đính kèm file */


	/*=====================================
		 * THIET LAP NOI DUNG EMAIL
	*=====================================*/

	//Thiết lập tiêu đề
	$mail->Subject    = $config_send_mail['subject'];
	$mail->IsHTML(true);
	//Thiết lập định dạng font chữ
	$mail->CharSet = "utf-8";

	$mail->Body = $body;
	if (!empty($config_send_mail['AddAttachment'])) {
		foreach ($config_send_mail['AddAttachment'] as $key => $value) {
			$mail->AddAttachment($value);
		}
	}
	return $mail->Send() ? 1 : 0;
}

function endsWith($haystack, $needle)
{
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}

function check_member()
{
	if (!empty($_SESSION['member'])) {
		return true;
	}
	return false;
}

function group_by($key, $data)
{
	$result = array();
	foreach ($data as $val) {
		if (array_key_exists($key, $val)) {
			$result[$val[$key]][] = $val;
		} else {
			$result[""][] = $val;
		}
	}
	return $result;
}



function xml2array($xmlObject, $out = array())
{
	foreach ((array) $xmlObject as $index => $node)
		$out[$index] = (is_object($node)) ? xml2array($node) : $node;
	return $out;
}

function match_iframe_src($string)
{
	preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $string, $matches);
	return $matches[1];
}

function replace_sodienthoai($str)
{
	return preg_replace('/[^0-9]/', '', $str);
}

function rewrite_link($lang = '', $link)
{
	return $str = ($lang) ? $lang . '/' . $link : $link;
}
/**
 * check recaptcha v2
 * $res = post_captcha($_POST['g-recaptcha-response']);
 * if (!$res['success']) {
 * 	do something
 * }
 */
function post_captcha($user_response, $secret)
{
	$fields_string = '';
	$fields = array(
		'secret' => '6Ldc5D8UAAAAANianohKqKr2mwZjJPS_Hlp7mhYn',
		'response' => $user_response
	);
	foreach ($fields as $key => $value)
		$fields_string .= $key . '=' . $value . '&';
	$fields_string = rtrim($fields_string, '&');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
	curl_setopt($ch, CURLOPT_POST, count($fields));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	curl_close($ch);

	return json_decode($result, true);
}

function check_google_recaptcha_v3($google_recaptcha_secret_key = '', $recaptcha_response = '')
{
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = $google_recaptcha_secret_key;
	$recaptcha_response = $recaptcha_response;
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	$recaptcha = json_decode($recaptcha);
	if ($recaptcha->score >= 0.5) {
		return true;
	} else {
		return false;
	}
}
function br2nl($string)
{
	return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}
function nl2br2($string)
{
	$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
	return $string;
}
/**
 * ob_start("ob_html_compress");
 * code cần nén để ở đây
 * ob_end_flush();
 */
function ob_html_compress($buf)
{
	$buf = preg_replace(array("/\n/", "/\r/", "/\t/"), '', $buf);
	return $buf;
}


function check_login()
{
	return true;
}
function encrypt_password($str, $salt, $salt2)
{
	return md5($salt . $str . $salt2);
}
function rand_color()
{
	return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
function checkValidUrl($url)
{
	$regex = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	return preg_match($regex, $url);
}

function searchForId($id, $array)
{
	foreach ($array as $key => $val) {
		if ($val['id'] === $id) {
			return $key;
		}
	}
	return null;
}
function isMember()
{
	if (empty($_SESSION['member'])) {
		return false;
	}
	return true;
}
function _fetch_array($sql)
{
	global $d;
	$d->reset();
	$d->query($sql);
	return $d->fetch_array();
}

function _result_array($sql)
{
	global $d;
	$d->reset();
	$d->query($sql);
	return $d->result_array();
}

function _get_info_member($column, $except)
{
	return _result_array("SELECT `{$column}` FROM table_member WHERE `{$column}` like `{$except}`");
}
function getIDyoutube($urlYoutube)
{
	$x2 = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $urlYoutube, $matches);
	return $matches[1];
}

function getImgYoutube($urlYoutube)
{
	return "https://img.youtube.com/vi/" . getIDyoutube($urlYoutube) . "/0.jpg";
}

function checkphantram($giacu, $giamoi)
{
	$phantramgiam = (100 - $phantram = ($giamoi / $giacu) * 100);
	if ($phantramgiam > 0) {
		return $phantramgiam;
	}
}

function check_array($array)
{
	echo "</*pre*/>";
	print_r($array);
	echo "</pre>";
}

function format_money($gia, $donvi, $lienhe = "Liên hệ")
{
	if ($gia > 0) {
		$str = number_format($gia, 0, ",", ".");
		$str = $str . $donvi;
	} else {
		$str = $lienhe;
	}
	return $str;
}

function format_money2($gia, $lienhe)
{
	if (!empty($gia) || $gia > 0) {
		$str = $gia;
	} else {
		$str = $lienhe;
	}
	return $str;
}

function magic_quote($str, $id_connect = false)
{
	if (is_array($str)) {
		foreach ($str as $key => $val) {
			$str[$key] = escape_str($val);
		}
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}
	if (get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') and is_resource($id_connect)) {
		return mysql_real_escape_string($str, $id_connect);
	} elseif (function_exists('mysql_escape_string')) {
		return mysql_escape_string($str);
	} else {
		return addslashes($str);
	}
}

function madonhang($matv, $table)
{
	global $d;
	$sql = "select id from table_$table order by id desc limit 0,1";
	$d->query($sql);
	$result = $d->result_array();
	if (count($result) == 0) {
		$kq = $matv . "_000001";
	} else {
		$id = $result[0]['id'] + 1;
		$leng = strlen($id);
		if ($leng == 1) {
			$kq = $matv . "_00000" . $id;
		} else if ($leng == 2) {
			$kq = $matv . "_0000" . $id;
		} else if ($leng == 3) {
			$kq = $matv . "_000" . $id;
		} else if ($leng == 4) {
			$kq = $matv . "_00" . $id;
		} else if ($leng == 5) {
			$kq = $matv . "_0" . $id;
		} else {
			$kq = $matv . "_" . $id;
		}
	}
	$kq = $kq . '-' . date('dmY');
	return $kq;
}
function phanquyen_tv($com, $quyen, $act, $type)
{
	global $d;


	$text_act = explode('_', $act);
	$text_act = $text_act[1];

	$d->reset();
	$sql = "select * from #_phanquyen where id='" . $quyen . "' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();

	$d->reset();
	$sql = "select * from #_com where ten_com='" . $com . "' and act ='" . $text_act . "' and type ='" . $type . "' ";
	$d->query($sql);
	$com_manager = $d->fetch_array();

	$xem_s = json_decode($phanquyen['xem']);
	$them_s = json_decode($phanquyen['them']);
	$xoa_s = json_decode($phanquyen['xoa']);
	$sua_s = json_decode($phanquyen['sua']);

	$xem_arr = explode('|', "capnhat|man|man_list|man_cat|man_item|man_sub");
	$them_arr = explode('|', "add|add_cat|add_list|add_item|add_sub|save|save_list|save_cat|save_item|save_sub");
	$xoa_arr = explode('|', "delete|delete_list|delete_cat|delete_item,delete_sub");
	$sua_arr = explode('|', "edit|edit_list|edit_cat|edit_item|edit_sub|save|save_list|save_cat|save_item|save_sub");

	if (in_array($act, $xem_arr)) {
		if (in_array($com_manager['id'] . '|1', $xem_s)) {
			return 1;
		} else {
			return 0;
		}
	} elseif (in_array($act, $them_arr)) {
		if (in_array($com_manager['id'] . '|1', $them_s)) {
			return 1;
		} else {
			return 0;
		}
	} elseif (in_array($act, $xoa_arr)) {
		if (in_array($com_manager['id'] . '|1', $xoa_s)) {
			return 1;
		} else {
			return 0;
		}
	} elseif (in_array($act, $sua_arr)) {
		if (in_array($com_manager['id'] . '|1', $sua_s)) {
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}
function phanquyen_edit($quyen, $role, $vitri)
{
	global $d, $kiemtra;

	$d->reset();
	$sql = "select * from #_phanquyen where id='" . $quyen . "' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();

	$com_s = json_decode($phanquyen['com']);
	$vitri_s = json_decode($phanquyen['table_vitri']);
	$sua_s = json_decode($phanquyen['sua']);

	if ($role == 3) {
		$kiemtra = 1;
	} else {
		for ($i = 0; $i < count($vitri_s); $i++) {
			if ($vitri_s[$i] == $vitri) {
				if (in_array($i . '|1', $sua_s)) {
					$kiemtra = 1;
				}
			}
		}
	}
	return $kiemtra;
}
function fns_Rand_digit($min, $max, $num)
{
	$result = '';
	for ($i = 0; $i < $num; $i++) {
		$result .= rand($min, $max);
	}
	return $result;
}
function get_tong_tien($id = 0)
{
	global $d;
	if ($id > 0) {
		$d->reset();
		$sql = "select tonggia from #_order where id='" . $id . "'";
		$d->query($sql);
		$tongtien = $d->fetch_array();
		return $tongtien['tonggia'];
	} else return 0;
}
function upload_photos($file, $extension, $folder, $newname = '')
{
	if (isset($file) && !$file['error']) 
	{

		$ext = end(explode('.', $file['name']));
		$name = basename($file['name'], '.' . $ext);

		if (strpos($extension, $ext) === false) {

			alert('Chỉ hỗ trợ upload file dạng ' . $ext . '-////-' . $extension);
			return false;
		}

		if ($newname == '' && file_exists($folder . $file['name']))
			for ($i = 0; $i < 100; $i++) {
				if (!file_exists($folder . $name . $i . '.' . $ext)) {
					$file['name'] = $name . $i . '.' . $ext;
					break;
				}
			} else {
				$file['name'] = $newname . '.' . $ext;
			}

			if (!copy($file["tmp_name"], $folder . $file['name'])) {
				if (!move_uploaded_file($file["tmp_name"], $folder . $file['name'])) {
					return false;
				}
			}
			return $file['name'];
		}
		return false;
	}
	function escape_str($str, $id_connect = false)
	{
		if (is_array($str)) {
			foreach ($str as $key => $val) {
				$str[$key] = escape_str($val);
			}

			return $str;
		}

		if (is_numeric($str)) {
			return $str;
		}

		if (get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}

		if (function_exists('mysql_real_escape_string') and is_resource($id_connect)) {
			return "'" . mysql_real_escape_string($str, $id_connect) . "'";
		} elseif (function_exists('mysql_escape_string')) {
			return "'" . mysql_escape_string($str) . "'";
		} else {
			return "'" . addslashes($str) . "'";
		}
	}

	function make_date($time, $dot = '.', $lang = 'vi', $f = false)
	{
		$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y", $time) : date("m{$dot}d{$dot}Y", $time);
		if ($f) {
			$thu['vi'] = array('Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7');
			$thu['en'] = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			$str = $thu[$lang][date('w', $time)] . ' ' . $str;
		}
		return $str;
	}
	function count_online()
	{
		global $d;
		$time = 600;
		$ssid = session_id();
		$sql = "delete from #_online where time<" . (time() - $time);
		$d->query($sql);
		$sql = "select id,session_id from #_online order by id desc";
		$d->query($sql);
		$result['dangxem'] = $d->num_rows();
		$rows = $d->result_array();
		$i = 0;
		while (($rows[$i]['session_id'] != $ssid) && $i++ < $result['dangxem']);

		if ($i < $result['dangxem']) {
			$d->query($sql);
			$data['time'] = time();
			$d->setTable('online');
			$d->setWhere('session_id', $ssid);
			$d->update($data);
			$result['daxem'] = $rows[0]['id'];
		} else {
			$sql = "insert into #_online (session_id, time) values ('" . $ssid . "', '" . time() . "')";

			$data['session_id'] = $ssid;
			$data['time'] = time();
			$d->setTable('online');
			$d->insert($data);
			$result['daxem'] = mysql_insert_id();
			$result['dangxem']++;
		}

		return $result;
	}

	function delete_file($file)
	{
		return @unlink($file);
	}


	function upload_image($file, $extension, $folder, $newname = '', $convert_jpg = false)
	{
		if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
			$ext = end(explode('.', $_FILES[$file]['name']));
			$name = basename($_FILES[$file]['name'], '.' . $ext);

			if (strpos($extension, $ext) === false) {
				alert('Chỉ hỗ trợ upload file dạng ' . $extension);
			return false; // không hỗ trợ
		}

		if ($newname == '' && file_exists($folder . $_FILES[$file]['name']))
			for ($i = 0; $i < 100; $i++) {
				if (!file_exists($folder . $name . $i . '.' . $ext)) {
					$_FILES[$file]['name'] = $name . $i . '.' . $ext;
					break;
				}
			} else {
				$_FILES[$file]['name'] = $newname . '.' . $ext;
			}
			if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
				if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
					return false;
				}
			}
			return $_FILES[$file]['name'];
		}
		return false;
	}

	function chuanhoa($s)
	{
		$s = str_replace("←", '&larr;', $s);
		return $s;
	}

	function themdau($s)
	{
		$s = addslashes($s);
		return $s;
	}

	function bodau($s)
	{
		$s = stripslashes($s);
		return $s;
	}


	function transfer($msg, $page = "index.php", $stt = true)
	{
		$showtext = $msg;
		$page_transfer = $page;
		include("./templates/transfer_tpl.php");
		exit();
	}

	function redirect($url = '')
	{
		echo '<script language="javascript">window.location = "' . $url . '" </script>';
		exit();
	}

	function back($n = 1)
	{
		echo '<script language="javascript">history.go = "' . -intval($n) . '" </script>';
		exit();
	}

	function dump($arr, $exit = 1)
	{
		echo "<pre>";
		var_dump($arr);
		echo "<pre>";
		if ($exit)	exit();
	}
	function paging_home($r, $url = '', $curPg = 1, $mxR = 5, $mxP = 5, $class_paging = '')
	{
		if ($curPg < 1) $curPg = 1;
		if ($mxR < 1) $mxR = 5;
		if ($mxP < 1) $mxP = 5;
		$totalRows = count($r);
		if ($totalRows == 0)
			return array('source' => NULL, 'paging' => NULL);
		$totalPages = ceil($totalRows / $mxR);




		if ($curPg > $totalPages) $curPg = $totalPages;

		$_SESSION['maxRow'] = $mxR;
		$_SESSION['curPage'] = $curPg;

		$r2 = array();
		$paging = "";

	//-------------tao array------------------
		$start = ($curPg - 1) * $mxR;
		$end = ($start + $mxR) < $totalRows ? ($start + $mxR) : $totalRows;
	#echo $start;
	#echo $end;

		$j = 0;
		for ($i = $start; $i < $end; $i++)
			$r2[$j++] = $r[$i];

	//-------------tao chuoi------------------
		$curRow = ($curPg - 1) * $mxR + 1;
		if ($totalRows > $mxR) {

			$from = $curPg - $mxP;
			$to = $curPg + $mxP;
			if ($from <= 0) {
				$from = 1;
				$to = $mxP * 2;
			}
			if ($to > $totalPages) {
				$to = $totalPages;
			}
			for ($j = $from; $j <= $to; $j++) {
				if ($j == $curPg) $links = $links . "<a class=\"paginate_active\" href=\"#\">{$j}</a>";
				else {
					$qt = $url . "&p={$j}";
					$links = $links . "<a class=\"paginate_button\" href = '{$qt}'>{$j}</a>";
				}
		} //for

		//$paging.= "Go to page :&nbsp;&nbsp;" ;
		if ($curPg > $mxP) {
			$paging .= " <a href='" . $url . "' class=\"first paginate_button\" >&laquo;</a> "; //ve dau				
			$paging .= " <a href='" . $url . "&p=" . ($curPg - 1) . "' class=\"previous paginate_button\" >&#8249;</a> "; //ve truoc
		} else {
			$paging .= " <a href='" . $url . "' class=\"first paginate_button paginate_button_disabled\" >&laquo;</a> "; //ve dau				
			$paging .= " <a href='" . $url . "&p=" . ($curPg - 1) . "' class=\"previous paginate_button paginate_button_disabled\" >&#8249;</a> "; //ve truoc
		}
		$paging .= $links;
		if (((int) (($curPg - 1) / $mxP + 1) * $mxP) < $totalPages) {
			$paging .= " <a href='" . $url . "&p=" . ($curPg + 1) . "' class=\"next paginate_button\" >&#8250;</a> "; //ke				
			$paging .= " <a href='" . $url . "&p=" . ($totalPages) . "' class=\"last paginate_button\" >&raquo;</a> "; //ve cuoi
		} else {
			$paging .= " <a href='" . $url . "&p=" . ($curPg + 1) . "' class=\"next paginate_button paginate_button_disabled\" >&#8250;</a> "; //ke				
			$paging .= " <a href='" . $url . "&p=" . ($totalPages) . "' class=\"last paginate_button paginate_button_disabled\" >&raquo;</a> "; //ve cuoi
		}
	}
	$r3['curPage'] = $curPg;
	$r3['source'] = $r2;
	$r3['paging'] = $paging;
	$r3['totalRows'] = $totalRows;
	#echo '<pre>';var_dump($r3);echo '</pre>';
	return $r3;
}
function catchuoi($chuoi, $gioihan)
{
	if (strlen($chuoi) <= $gioihan) {
		return $chuoi;
	} else {
		if (strpos($chuoi, " ", $gioihan) > $gioihan) {
			$new_gioihan = strpos($chuoi, " ", $gioihan);
			$new_chuoi = substr($chuoi, 0, $new_gioihan) . "...";
			return $new_chuoi;
		}
		$new_chuoi = substr($chuoi, 0, $gioihan) . "...";
		return $new_chuoi;
	}
}

function stripUnicode($str)
{
	if (!$str) return false;
	$unicode = array(
		'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd' => 'đ',
		'D' => 'Đ',
		'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i' => 'í|ì|ỉ|ĩ|ị',
		'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
		'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
		'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
	);
	foreach ($unicode as $khongdau => $codau) {
		$arr = explode("|", $codau);
		$str = str_replace($arr, $khongdau, $str);
	}
	return $str;
}

function pagination($query, $per_page = 10, $page = 1, $url = '?', $class = 'pagination-sm')
{
	global $d;

	$sql = "SELECT COUNT(*) as `num` FROM {$query}";
	$d->query($sql);
	$row = $d->fetch_array();
	$total = $row['num'];
	$adjacents = "1";

	$prevlabel = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	$nextlabel = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
	$lastlabel = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';

	$page = ($page == 0 ? 1 : $page);
	$start = ($page - 1) * $per_page;

	$prev = $page - 1;
	$next = $page + 1;

	$lastpage = ceil($total / $per_page);

	$lpm1 = $lastpage - 1;

	$pagination = "";
	if ($lastpage > 1) {
		$pagination .= "<ul class='pagination $class'>";
		if ($page > 1) $pagination .= "<li class='prev'><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";

		if ($lastpage < 7 + ($adjacents * 2)) {
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$pagination .= "<li class='active'><a>{$counter}</a></li>";
				else
					$pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
			}
		} elseif ($lastpage > 5 + ($adjacents * 2)) {

			if ($page < 1 + ($adjacents * 2)) {

				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page)
						$pagination .= "<li class='active'><a>{$counter}</a></li>";
					else
						$pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination .= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination .= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

				$pagination .= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination .= "<li><a href='{$url}&page=2'>2</a></li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class='active'><a>{$counter}</a></li>";
					else
						$pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
				$pagination .= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
				$pagination .= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
			} else {

				$pagination .= "<li><a href='{$url}&page=1'>1</a></li>";
				$pagination .= "<li><a href='{$url}&page=2'>2</a></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class='active'><a>{$counter}</a></li>";
					else
						$pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
				}
			}
		}
		if ($page < $counter - 1) {
			$pagination .= "<li class='next'><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";
			$pagination .= "<li class='last'><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
		}

		$pagination .= "</ul>";
	}

	return $pagination;
}

function changeTitle($str)
{

	$str = stripUnicode($str);
	if (function_exists('mb_convert_case')) {
		$str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
	} else {
		$str = strtolower($str);
	}

	$str = trim($str);
	$str = preg_replace('/[^a-zA-Z0-9\ ]/', '', $str);
	$str = str_replace(".", "-", $str);
	$str = str_replace("  ", " ", $str);
	$str = str_replace(" ", "-", $str);
	return $str;
}
function images_name($tenhinh)
{
	$rand = rand(10, 9999);
	$ten_anh = explode(".", $tenhinh);
	$result = changeTitle($ten_anh[0]) . "-" . $rand;
	return $result;
}

function chuyengu($lang = '')
{
	$uri = $_SERVER['REQUEST_URI'];
	if ($lang != '') {
		$x = preg_split('/\/(en|vi|????)\//', $uri);
		$uri = $lang . '/' . str_replace(array('vi/', 'en/'), '', $x[1]);
	}
	return $uri;
}

function getCurrentPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	$pageURL = explode("&page=", $pageURL);
	return $pageURL[0];
}
function getCurrentPage()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
function create_thumb($file, $width, $height, $folder, $file_name, $zoom_crop = '1')
{

	// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?
	$new_width   = $width;
	$new_height   = $height;

	if ($new_width && !$new_height) {
		$new_height = floor($height * ($new_width / $width));
	} else if ($new_height && !$new_width) {
		$new_width = floor($width * ($new_height / $height));
	}

	$image_url = $folder . $file;
	$origin_x = 0;
	$origin_y = 0;
	// GET ORIGINAL IMAGE DIMENSIONS
	$array = getimagesize($image_url);
	if ($array) {
		list($image_w, $image_h) = $array;
	} else {
		die("NO IMAGE $image_url");
	}
	$width = $image_w;
	$height = $image_h;

	// ACQUIRE THE ORIGINAL IMAGE
	$image_ext = trim(strtolower(end(explode('.', $image_url))));
	switch (strtoupper($image_ext)) {
		case 'JPG':
		case 'JPEG':
		$image = imagecreatefromjpeg($image_url);
		$func = 'imagejpeg';
		break;
		case 'PNG':
		$image = imagecreatefrompng($image_url);
		$func = 'imagepng';
		break;
		case 'GIF':
		$image = imagecreatefromgif($image_url);
		$func = 'imagegif';
		break;

		default:
		die("UNKNOWN IMAGE TYPE: $image_url");
	}

	// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}
	}

	// create a new true color image
	$canvas = imagecreatetruecolor($new_width, $new_height);
	imagealphablending($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {

			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round($origin_x - ($new_width / 2));
		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round($origin_y - ($new_height / 2));
		}
	}

	// Restore transparency blending
	imagesavealpha($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round($width / $cmp_x * $cmp_y);
			$src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
		} else if ($cmp_y > $cmp_x) {

			$src_h = round($height / $cmp_y * $cmp_x);
			$src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
		}

		// positional cropping!
		if ($align) {
			if (strpos($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
	} else {

		// copy and resize part of an image with resampling
		imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	}



	$new_file = $file_name . '_' . $new_width . 'x' . $new_height . '.' . $image_ext;
	// SHOW THE NEW THUMB IMAGE
	if ($func == 'imagejpeg') $func($canvas, $folder . $new_file, 100);
	else $func($canvas, $folder . $new_file, floor($quality * 0.09));

	return $new_file;
}
function ChuoiNgauNhien($sokytu)
{
	$chuoi = "ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
	$giatri = '';
	for ($i = 0; $i < $sokytu; $i++) {
		$vitri = mt_rand(0, strlen($chuoi));
		$giatri = $giatri . substr($chuoi, $vitri, 1);
	}
	return $giatri;
}
function pagesListLimitadmin($url, $totalRows, $pageSize = 5, $offset = 5)
{
	$links = '';
	if ($totalRows <= 0) return "";
	$totalPages = ceil($totalRows / $pageSize);
	if ($totalPages <= 1) return "";
	if (isset($_GET["page"]) == true)  $currentPage = $_GET["page"];
	else $currentPage = 1;
	settype($currentPage, "int");
	if ($currentPage <= 0) $currentPage = 1;
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a></li>";
	$lastLink = "<li><a href=\"{$url}&page={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;
	$to = $currentPage + $offset;
	if ($from <= 0) {
		$from = 1;
		$to = $offset * 2;
	}
	if ($to > $totalPages) {
		$to = $totalPages;
	}
	for ($j = $from; $j <= $to; $j++) {
		if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";
		else {
			$qt = $url . "&page={$j}";
			$links = $links . "<li><a href = '{$qt}'>{$j}</a></li>";
		}
	} //for
	return '<ul class="pages">' . $firstLink . $links . $lastLink . '</ul>';
} // function pagesListLimit
function format_size($rawSize)
{
	if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
	else 
		if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
	else
		return round($rawSize, 1) . ' Bytes';
}
function convert_number_to_words($number)
{
	$hyphen      = ' ';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'âm ';
	$decimal     = ' phẩy ';
	$dictionary  = array(
		0                   => '0',
		1                   => '1',
		2                   => '2',
		3                   => '3',
		4                   => '4',
		5                   => '5',
		6                   => '6',
		7                   => '7',
		8                   => '8',
		9                   => '9',
		10                  => 'Mười',
		11                  => 'Mười Một',
		12                  => 'Mười Hai',
		13                  => 'Mười Ba',
		14                  => 'Mười Bốn',
		15                  => 'Mười Lăm',
		16                  => 'Mười Sáu',
		17                  => 'Mười Bảy',
		18                  => 'Mười Tám',
		19                  => 'Mười Chín',
		20                  => 'Hai Mươi',
		30                  => 'Ba Mươi',
		40                  => 'Bốn Mươi',
		50                  => 'Năm Mươi',
		60                  => 'Sáu Mươi',
		70                  => 'Bảy Mươi',
		80                  => 'Tám Mươi',
		90                  => 'Chín Mươi',
		100                 => 'Trăm',
		1000                => 'Ngàn',
		1000000             => 'Triệu',
		1000000000          => 'Tỷ',
		1000000000000       => 'Nghìn Tỷ',
		1000000000000000    => 'Ngàn Triệu Triệu',
		1000000000000000000 => 'Tỷ Tỷ'
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
		case $number < 21:
		$string = $dictionary[$number];
		break;
		case $number < 100:
		$tens   = ((int) ($number / 10)) * 10;
		$units  = $number % 10;
		$string = $dictionary[$tens];
		if ($units) {
			$string .= $hyphen . $dictionary[$units];
		}
		break;
		case $number < 1000:
		$hundreds  = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
		default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
		}
		break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}

function gia($giaban = 0, $giacu = 0)
{
	if ($giaban != 0 && $giacu == 0) {
		$str 	= '<strong>' . format_money($giaban, 'đ', '<a href="lien-he">Liên hệ</a>') . '</strong>';
	} elseif ($giaban != 0 && $giacu != 0) {
		$str 	= '<strong>' . format_money($giaban, 'đ', '<a href="lien-he">Liên hệ</a>') . '</strong> <del>' . format_money($giacu, 'đ', '<a href="lien-he">Liên hệ</a>') . '</del>';
	} else {
		$str 	= '<a href="lien-he">Liên hệ</a>';
	}
	return $str;
}


function sanpham($value = array(), $class_ = 'col-product col-flex-4 wow fadeInUpSmall', $lazy = 'data-src')
{
	$info 	= '';
	$gia 	= !empty($value['giaban']) ? '<span class="gia">'.$value['giaban'].'</span>' : '';
	$info 	.= !empty($value['loainha']) ? '<p>Loại nhà: '. $value['loainha'] .'</p>' : '';
	$info 	.= !empty($value['huong']) ? '<p>Hướng: '. $value['huong'] .'</p>' : '';
	$info 	.= !empty($value['dien_tich']) ? '<p>Diện tích: '. $value['dien_tich'] .'</p>' : '';
	$info 	.= '<p>Ngày đăng: '. date('d-m-Y',$value['ngaytao']) .'</p>';
	?>
	<div class="<?php echo $class_ ?>">
		<div class="san-pham clearfix">
			<figure>
				<a href="<?php echo $value['tenkhongdau'] ?>" class="full" title="<?php echo $value['ten'] ?>"></a>
				<img <?php echo $lazy; ?>="watermark/300x375/1/<?php echo _upload_product_l . $value['photo'] ?>" alt="<?php echo $value['ten'] ?>" class="img-full">
				<?php echo $gia ?>
			</figure>
			<div class="san-pham-content">
				<h2>
					<a href="<?php echo $value['tenkhongdau'] ?>"  title="<?php echo $value['ten'] ?>"><?php echo $value['ten'] ?></a>
				</h2>
				<?php echo $info ?>
			</div>
		</div>
	</div>
<?php }
function tintuc3($value = array(), $class_ = "col-tin-tuc col-flex-lg-6 col-flex-xl-6 col-flex-md-12 wow fadeInUpSmall", $src = "data-src")
{ 
	?>
	<div class="<?php echo $class_ ?>">
		<div class="first-news clearfix">
			<figure>
				<a href="<?php echo $value['tenkhongdau'] ?>">
					<img data-src="thumb/250x170/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
				</a>
			</figure>
			<div>
				<h2>
					<a href="<?php echo $value['tenkhongdau'] ?>"><?php echo $value['ten'] ?></a>
				</h2>
				<span>
					<i class="fa fa-calendar" aria-hidden="true"></i>Ngày <?php echo date('d/m/Y',$value['ngaytao']) ?>
				</span>
				<p>
					<?php echo catchuoi(strip_tags($value['mota']),300) ?>
				</p>
			</div>
		</div>
	</div>
<?php }

function isAjaxRequest()
{
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
		return true;
	return false;
}

function meta_data($data = array())
{
	$thumbnail =  SITE_URI . '/' . $data['thumbnail'];
	$subject = (!empty($data['subject'])) ?  $data['subject'] : 'product';
	return $share_facebook .= '
	<!-- Facebook Meta Tags -->
	<meta name="og:url" property="og:url" content="' . getCurrentPageURL() . '" />
	<meta name="og:type" property="og:type" content="' . $subject . '" />
	<meta name="og:title" property="og:title" content="' . $data['ten'] . '" />
	<meta name="og:description" property="og:description" content="' . $data['seo_description'] . '" />
	<meta name="og:image" property="og:image" content="' . $thumbnail . '" />		

	<!-- Dublin Core Metadata -->
	<meta name="DC.title" content="' . $data['ten'] . '">
	<meta name="DC.identifier" content="' . getCurrentPageURL() . '">
	<meta name="DC.description" content="' . $data['seo_description'] . '">
	<meta name="DC.subject" content="' . $subject . '">

	<!-- Google / Search Engine Tags -->
	<meta itemprop="name" content="' . $data['ten'] . '">
	<meta itemprop="description" content="' . $data['seo_description'] . '">
	<meta itemprop="image" content="' . $thumbnail . '">

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="' . $data['ten'] . '">
	<meta name="twitter:description" content="' . $data['seo_description'] . '">
	<meta name="twitter:image" content="' . $thumbnail . '">';
}

function breadcrumb($data = array())
{
	global $com;
	$str = '<ul class="breadcrumb">';
	$str .= '<li> <a href="' . SITE_URI . '" title="' . _trangchu . '">' . _trangchu . '</a> </li>';
	if ($data['first'] && $com != 'bat-dong-san') {
		$str .= '<li><a href="' . $data['first']['link'] . '" title="' . $data['first']['ten'] . '">' . $data['first']['ten'] . '</a></li>';
	}
	foreach ($data['item'] as $value) {
		if ((int) $value['id'] == 0) {
			break;
		}
		$item = _fetch_array("SELECT ten_vi as ten,tenkhongdau,id from table_" . $value['table'] . " where id = '" . $value['id'] . "' and hienthi = 1");
		$str .= !empty($item) ? '<li><a href="' . $item['tenkhongdau'] . '" title="' . $item['ten'] . '">' . $item['ten'] . '</a></li>' : '';
	}
	$str .= '<li>' . $data['last'] . '</li> </ul>';
	return $str;
}
