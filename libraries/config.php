<?php
$cautruyvan = strtolower(json_encode($_REQUEST));
$tukhoa = array('union','chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(',
	'cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20',
	'union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=',
	'esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(',
	'mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm',
	'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(',
	'chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(',
	'locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall',
	'passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20',
	'insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20',
	'$_request', '$_get', '$request', '$get', '.system', '&aim', '%20getenv', 'getenv%20',
	'new_password', '&icq','/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow',
	'/bin/ps', 'wget%20', 'uname\x20-a', '/usr/bin/id','/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g\+\+', 'bin/python',
	'bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20',
	'/bin/mail', '.conf', 'motd%20', '_config.php', 'cgi-', '.eml',
	'file\://', 'window.open', 'javascript\://','img src', 'img%20src','.jsp','ftp.exe',
	'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd',
	'servlet', '/etc/passwd', '[Only registered and activated users can see links]', '~root', '~ftp', '.js', '.jsp', '.history',
	'bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20',
	'powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from',
	'select from', 'drop%20', '.system', 'getenv', '_php', 'php_', 'phpinfo()', '<?php', '?>', 'sql=');
$kiemtra = str_replace($tukhoa, '*', $cautruyvan);
if ($cautruyvan != $kiemtra){
	header("HTTP/1.0 404 Not Found");
	die( "404 Not found" );
}

if(!defined('_lib')) die("Error");
error_reporting(E_ALL);
date_default_timezone_set('Asia/Ho_Chi_Minh');
define ( 'NN_MSHD' , '1251620');
define ( 'NN_AUTHOR' , 'tranquoclocnina@gmail.com');

// Salt
$config_path 							= "tothithumai_21_05_2020_".NN_MSHD;
$config_url								= $_SERVER["SERVER_NAME"].'/'.$config_path;
$url_web 								= 'http://'.$config_url;
$_SESSION['base'] 						= $url_web;
$config['debug'] 						= 0;
$config['lang'] 						= array('vi');
$config['edit'] 						= false;
$config_email							= "admin@demo112.ninavietnam.com.vn";
$config_pass							= "Yv2tVv18";
$config_ip								= "116.193.76.23";

$config['author']['ten'] 				= 'Trần Quốc Lộc';
$config['author']['email'] 				= 'tranquoclocnina@gmail.com';
$config['author']['ngay_hoan_thanh'] 	= '14/05/2020';

$config['database']['servername'] 		= 'localhost';
$config['database']['username'] 		= 'root';
$config['database']['password'] 		= '';
$config['database']['database'] 		= 'db_'.$config_path;
$config['database']['refix'] 			= 'table_';

$config['google_recaptcha_v3'] 			= false;
$config['site_key']   					= "";
$config['secret_key'] 					= "";

$config['salt'] 						= 'ImfLReYMytxwSHPkhzc0BapX9Zvijr';
$config['salt2'] 						= 'IfJWb2LeYMKxlw3PhzcoGVAagnijrO';

$config['google_recaptcha_v2'] 			= false;
$config['site_key_v2']   				= "";
$config['secret_key_v2'] 				= "";

$config['login']['attempt'] 			= 5; // Số lần cho phép đăng nhập sai
$config['login']['delay'] 				= 15; // Thời gian chờ khi cho phép đăng nhập lại

// H89wZ6ekEPKDVpq	 -   051b68879f557f5b2e2cc3a7c3dd3eb3

// Language Ex: Việt - Anh - Trung
$ar_lang = array(
	array('slug'=>'vi','ten'=>'','active'=>'active','img'=>'vi.png'),
);
if ($_GET['lang'] !='' && in_array($_GET['lang'], $config['lang'] )) {
	$lang = $_GET['lang'];
} else {
	$lang = 'vi';
}

if (!isset($_SESSION['lang_'.$config_path])) {
	$_SESSION['lang_'.$config_path] = 'vi';
}
$lang = $_SESSION['lang_'.$config_path];

define('SITE_URI',$url_web);
$config_responsive = false;