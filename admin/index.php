<?php
session_start();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , '../libraries/');

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$lang = 'vi';


include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."type.php";
include_once _lib."functions.php";
include_once _lib."functions_giohang.php";
include_once _lib."library.php";
include_once _lib."class.database.php";	
include_once _lib."pclzip.php";

if(isset($_REQUEST['author'])){ 
	header('Content-Type: text/html; charset=utf-8');
	echo '<pre>';
	print_r($config['author']);
	echo '</pre>';
	die();
}


$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
$login_name = 'NINACO';	
$d = new database($config['database']);	
$archive = new PclZip($file);

/* Begin Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */
if(isset($_SESSION[$login_name]) || $_SESSION[$login_name]==true)
{
	$id_user = (int)$_SESSION['login']['id'];
	$timenow = time();

	$d->reset();
	$sql="select username,password,lastlogin,user_token from #_user WHERE id ='$id_user'";
	$d->query($sql);
	$row=$d->fetch_array();

	$sessionhash = md5(sha1($row['password'].$row['username']));
	
	if($_SESSION['login_session']!=$sessionhash || ($timenow - $row['lastlogin'])>3600)
	{
		session_destroy();
		redirect("index.php?com=user&act=login");
	}

	if($_SESSION['login_token']!==$row['user_token']) $notice_admin = 'Có người đang đăng nhập tài khoản của bạn !';
	else $notice_admin ='';

	$token = md5(time());
	$_SESSION['login_token'] = $token;

	/* Begin Cập nhật lại thời gian hoạt động và token */
	$d->reset();
	$sql = "update #_user set lastlogin = '$timenow',user_token = '$token' where id='$id_user'";
	$d->query($sql);
	/* End Cập nhật lại thời gian hoạt động và token */
}
/* End Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */

/* Begin Kiểm tra đăng nhập tài khoản sai theo số lần */
$ip = getRealIPAddress();
$d->reset();
$sql="select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit WHERE login_ip = '$ip' ORDER BY id DESC LIMIT 1 ";
$d->query($sql);
if($d->num_rows()==1)
{
	$row = $d->result_array();
	$id_login = $row[0]['id'];
	$time_now = time();
	if($row[0]['locked_time']>0)
	{
		$locked_time = $row[0]['locked_time'];
		$delay_time = $config['login']['delay'];
		$interval = $time_now  - $locked_time;
		if($interval <= $delay_time*60)
		{
			$time_remain = $delay_time*60 - $interval;
			$msg = "Xin lỗi..! Vui lòng thử lại sau ". round($time_remain/60)." phút..!";
			transfer($msg, "index.php?com=user&act=login");
		}
		else
		{
			$sql="update #_user_limit set login_attempts = 0,attempt_time = '$time_now' ,locked_time = 0 where id = '$id_login'";
			$d->query($sql);
		}
	}
}
/* End Kiểm tra đăng nhập tài khoản sai theo số lần */


switch($com){
	case 'dichvukemtheo':
	$source = "dichvukemtheo";
	break;	
	case 'order':
	$source = "order";
	break;
	case 'khachhang':
	$source = "khachhang";
	break;
	case 'background':
	$source = "background";
	break;
	case 'member':
	$source = "member";
	break;
	case 'size':
	$source = "size";
	break;
	case 'nhasanxuat':
	$source = "nhasanxuat";
	break;
	case 'mausac':
	$source = "mausac";
	break;
	case 'tieude':
	$source = "tieude";
	break;
	case 'album':
	$source = "album";
	break;
	case 'tags':
	$source = "tags";
	break;
	case 'video':
	$source = "video";
	break;
	case 'contact':
	$source = "contact";
	break;
	case 'gia':
	$source = "gia";
	break;
	case 'download':
	$source = "download";
	break;
	case 'tinhthanh':
	$source = "tinhthanh";
	break;
	case 'datnuoc':
	$source = "datnuoc";
	break;
	case 'post':
	$source = "post";
	break;
	case 'newsletter':
	$source = "newsletter";
	break;
	case 'phanquyen':
	$source = "phanquyen";
	break;
	case 'com':
	$source = "com";
	break;
	case 'company':
	$source = "company";
	break;
	case 'baiviet':
	$source = "baiviet";
	break;
	case 'database':
	$source = "database";
	break;
	case 'backup':
	$source = "backup";
	break;		
	case 'info':
	$source = "info";
	break;
	case 'slogan':
	$source = "slogan";
	break;
	case 'product':
	$source = "product";
	break;
	case 'user':
	$source = "user";
	break;		
	case 'lkweb':
	$source = "lkweb";
	break;		
	case 'photo':
	$source = "photo";
	break;	
	case 'audio':
	$source = "audio";
	break;															
	case 'setting':
	$source = "setting";
	break;										
	case 'yahoo':
	$source = "yahoo";
	break;
	case 'diachi':
	$source = "diachi";
	break;
	case 'excel':
	$source = "excel";
	break;										
	case 'bannerqc':
	$source = "bannerqc";
	break;
	case 'newdata':
	$source = "newdata";
	break;
	case 'linhvuc':
	$source = "linhvuc";
	break;
	case 'onesignal':
	$source = "onesignal";
	break;
	case 'option':
	$source = "option";
	break;
	default: 
	$source = "";
	$template = "index";
	break;
}

if(check_login()==false  && $act!="login"){		 
	redirect("index.php?com=user&act=login");
}


if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
	redirect("index.php?com=user&act=login");
}

if($_GET['act']=='man' || $_GET['act']=='man_cat' || $_GET['act']=='man_list' || $_GET['act']=='capnhat' || $_GET['act']=='man_photo' || $_GET['act']=='man_sub' || $_GET['act']=='man_item'){
	$_SESSION['links_re'] = getCurrentPage();
}

if($_SESSION['login']['role']==1 && $_GET['com']!='' && $_GET['act']!='logout' && $_GET['act']!='login'){
	if(phanquyen_tv($_GET['com'],$_SESSION['login']['quyen'],$_GET['act'],$_GET['type'])==0){
		$_SESSION['edit']['quyen'] = 'false';
		transfer("Bạn Không có quyền vào đây !","index.php");
	} else {
		$_SESSION['edit']['quyen'] = 'true';
	}
}

if($source!="") include _source.$source.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<?php if ($config_responsive): ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<?php else: ?>
			<meta name="viewport" content="width=1366">
		<?php endif ?>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Administrator - Hệ thống quản trị nội dung</title>
		<link href="css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/external.js"></script>
		<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
		<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
		<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
		<script src="js/jquery.minicolors.js"></script>
		<link rel="stylesheet" href="js/plugins/multiupload/assets/css/jquery.filer.css" />
		<link rel="stylesheet" href="css/jquery.minicolors.css">
		<script type="text/javascript" src="js/select2/select2.full.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/select2.min.css">
	</head>
	<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){
		/* Lưu lại thời gian khi vừa đăng nhập */
		$sql = "UPDATE table_user SET lastlogin = ".time()." WHERE username = '".$_SESSION['login']['username']."'";
		$d->query($sql);
		?>  
		
		<?php if($notice_admin!="") echo "<strong class='notifi-login'>".$notice_admin."</strong>"; ?>
		<style type="text/css">
			.notifi-login {
				position: absolute;
				right: 7px;
				top: 43px;
				padding: 8px 15px;
				border-radius: 3px;
				font-size: 13px;
				background: #f2dede;
				border: 1px solid #ebcccc;
				color: #a94442;
				z-index: 789;
			}
		</style>
	<?php } ?>
	<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  
		<body>
			<!-- Left side content -->    
			<script type="text/javascript">
				$(function(){
					var num = $('#menu').children(this).length;
					for (var index=0; index<=num; index++)
					{
						var id = $('#menu').children().eq(index).attr('id');
						$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
						$('#'+id+' .sub li:last-child').addClass('last');
					}
					$('#menu .activemenu .sub').css('display', 'block');
					$('#menu .activemenu a').removeClass('inactive');
					$('.conso').priceFormat({
						limit: 13,
						prefix: '',
						centsLimit: 0
					});
					
					$('.color').each( function() {
						$(this).minicolors({
							control: $(this).attr('data-control') || 'hue',
							defaultValue: $(this).attr('data-defaultValue') || '',
							format: $(this).attr('data-format') || 'hex',
							keywords: $(this).attr('data-keywords') || '',
							inline: $(this).attr('data-inline') === 'true',
							letterCase: $(this).attr('data-letterCase') || 'lowercase',
							opacity: $(this).attr('data-opacity'),
							position: $(this).attr('data-position') || 'bottom left',
							change: function(value, opacity) {
								if( !value ) return;
								if( opacity ) value += ', ' + opacity;
								if( typeof console === 'object' ) {
									console.log(value);
								}
							},
							theme: 'bootstrap'
						});

					});

				})
			</script>

			<div id="leftSide">
				<?php include _template."left_tpl.php";?>
			</div>
			<!-- Right side -->
			<div id="rightSide">
				<!-- Top fixed navigation -->
				<div class="topNav">
					<?php include _template."header_tpl.php";?>
				</div>

				<div class="wrapper">
					<?php include _template.$template."_tpl.php";?>
				</div></div>
				<div class="clear"></div>
			</body>
		<?php }else{?>
			<body class="nobg loginPage">   
				<?php include _template.$template."_tpl.php";?>
				<!-- Footer line -->
				<div id="footer">
					<div class="wrapper">Powered by <a href="http://www.nina.vn" title="Thiết kế web NINA">Thiết kế web NINA</a></div>
				</div></body>
			<?php } ?>

			<script>
				$(document).ready(function($) {
					$('.ck_editor').each(function(index, el) {
						var id = $(this).find('textarea').attr('id');
						CKEDITOR.replace( id, {       
							filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
							filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
							filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
							height: 500
						});
					});	
				});	
			</script>

			<script type="text/javascript">
				$(document).ready(function() {
					$('.select2').select2();
					/* ajax hienthi*/
					$("a.diamondToggle").click(function(){
						if($(this).attr("rel")==0){
							$.ajax({
								type: "POST",
								url: "ajax/ajax_hienthi.php",
								data:{
									id: $(this).attr("data-val0"),
									bang: $(this).attr("data-val2"),
									type: $(this).attr("data-val3"),
									value:1
								}
							});
							$(this).addClass("diamondToggleOff");
							$(this).attr("rel",1);
							
						}else{
							
							$.ajax({
								type: "POST",
								url: "ajax/ajax_hienthi.php",
								data:{
									id: $(this).attr("data-val0"),
									bang: $(this).attr("data-val2"),
									type: $(this).attr("data-val3"),
									value:0
								}
							});
							$(this).removeClass("diamondToggleOff");
							$(this).attr("rel",0);
						}

					});
					/*end  ajax hienthi*/
					/*select danhmuc*/
					<?php if (!$config_linhvuc_js) { ?>
						$(".select_danhmuc").change(function() {
							var child = $(this).data("child");
							var levell = $(this).data('level');
							var table = $(this).data('table');
							var type = $(this).data('type');
							$.ajax({
								url: 'ajax/ajax_danhmuc.php',
								type: 'POST',
								data: {level: levell,id:$(this).val(),table:table,type:type},
								success:function(data){
									var op = "<option>Chọn Danh Mục</option>";

									if(levell=='0'){
										$("#id_cat").html(op);
										$("#id_item").html(op);
										$("#id_sub").html(op);
									}else if(levell=='1'){
										$("#id_sub").html(op);
										$("#id_item").html(op);
									}else if(levell=='2'){
										$("#id_sub").html(op);
									}
									$("#"+child).html(data);
								}
							});
						});
					<?php } else { ?>
						$("#id_linhvuc").change(function(event) {
							var target = $(this).attr('data-target'),table = $(this).attr('data-table'),type=$(this).attr('data-type'),value = $(this).val();
							$.ajax({
								url: 'ajax/ajax_danhmuc_2.php',
								type: 'POST',
								data:{
									id:value,
									table:table,
									type:type
								},
								success:function(data){
									var op = "<option>Chọn Danh Mục</option>";
									$("#id_list").html(op);
									$("#id_cat").html(op);
									$("#id_item").html(op);
									$("#id_sub").html(op);
									$("#"+target).html(data);
								}
							});
						});
						$(".select_danhmuc").change(function() {
							var child = $(this).data("child");
							var levell = $(this).data('level');
							var table = $(this).data('table');
							var type = $(this).data('type');
							$.ajax({
								url: 'ajax/ajax_danhmuc.php',
								type: 'POST',
								data: {level: levell,id:$(this).val(),table:table,type:type},
								success:function(data){
									var op = "<option>Chọn Danh Mục</option>";

									if(levell=='0'){
										$("#id_cat").html(op);
										$("#id_item").html(op);
										$("#id_sub").html(op);
									}else if(levell=='1'){
										$("#id_sub").html(op);
										$("#id_item").html(op);
									}else if(levell=='2'){
										$("#id_sub").html(op);
									}
									$("#"+child).html(data);
								}
							});
						});
					<?php } ?>
					$(".select_diachi").change(function() {
						var table = $(this).attr('data-table'), target = $(this).attr('data-target'), id = $(this).val(), level = $(this).attr('data-level');
						$.ajax({
							url: 'ajax/ajax_tinh.php',
							type: 'POST',
							data:{
								table:table,
								id:id,
								level: level,
							},
							success:function(data){
								if (level == 0) {
									$("#cbo_huyen").html('<option value="0">-- Chọn Quận/Huyện --</option>');
									$("#cbo_phuong").html('<option value="0">-- Chọn Phường/Xã --</option>');
									$("#cbo_duong").html('<option value="0">-- Chọn đường --</option>');
								} else if(level == 1){
									$("#cbo_phuong").html('<option value="0">-- Chọn Phường/Xã --</option>');
									$("#cbo_duong").html('<option value="0">-- Chọn đường --</option>');
								} else if(level == 2){
									$("#cbo_duong").html('<option value="0">-- Chọn đường --</option>');
								}
								$("#"+target).html(data);
								$("#"+target).select2();
							}
						});
					});
				});
			</script>
			<script type="text/javascript">
				$(document).ready(function() {
					$(".description").keyup(function(event) {
						$("input.des_char_"+$(this).attr('cols')).val($(this).val().length);
					});
					$(window).bind('load', function(event) {
						$(".description").each(function(index, el) {
							$("input.des_char_"+$(this).attr('cols')).val($(".description[cols='"+$(this).attr('cols')+"']").val().length);
						});
					});
				});
			</script>
			<?php if ($config_responsive): ?>
				<div class="btn-open-menu">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
				<script>
					$(function(){
						$(".btn-open-menu").click(function(event) {
							$(this).toggleClass('active');
							$("#leftSide").toggleClass('active');
						});
					})
				</script>
			<?php endif ?>		
			<script type="text/javascript">
				initBrowserServer();
				function initBrowserServer(){
					$(".browser").click(function(){
						$change = false;
						if($(this).hasClass("show")){
							$change = true;
						}
						BrowseServer($(this).data("for"),$change);
						return false;
					})
				}
				function BrowseServer($id,$change)
				{
					var finder = new CKFinder();
					finder.selectActionFunction = function( fileUrl, data ) {
						$("#"+$id).val(fileUrl);
						if($change){
						}
					}
					finder.popup();
				}
			</script>			
			</html>
