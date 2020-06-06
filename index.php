<?php
session_start();
@define('_source', './sources/');
@define('_lib', './libraries/');
@define ( '_template' , './templates/');
include_once _lib . "config.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
include_once _lib . "constant.php";
include_once _source . "lang_".$lang.".php";
include_once _lib . "functions.php";
include_once _lib . "getdatahome.php";
include_once _lib . "file_requick.php";
include_once _lib . "counter.php";
$count_online = count_online();

if (isset($_GET['lang']) && $_GET['lang'] != '' && in_array($_GET['lang'], $config['lang'] )) {
	$lang = $_SESSION['lang_' . $config_path] = $_GET['lang'];
	header('location:' . $url_web);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
<head>	
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<base href="<?php echo $url_web ?>/">
	<link rel="canonical" href="<?= getCurrentPageURL() ?>" />

	<!-- dns prefetch -->
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="<?php echo $url_web ?>">
	<link rel="dns-prefetch" href="//facebook.com/">
	<link rel="dns-prefetch" href="//www.google-analytics.com/">
	<link rel="dns-prefetch" href="//www.youtube.com/">
	<link rel="dns-prefetch" href="//s7.addthis.com/">
	<link rel="dns-prefetch" href="//ajax.googleapis.com">
	<link id="favicon" rel="shortcut icon" href="<?= _upload_hinhanh_l . $favicon['thumb'] ?>" type="image/x-icon" />
	<title>
		<?php if ($title_bar != '') echo $title_bar;
		else echo $row_setting['title_' . $lang]; ?>
	</title>
	<meta name="description" content="<?php if ($description_bar != '') { echo $description_bar; } else { echo $row_setting['description_' . $lang]; } ?>">
	<meta name="keywords" content="<?php if ($keywords_bar != '') { echo $keywords_bar; } else { echo $row_setting['keywords_' . $lang]; } ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name='revisit-after' content='1 days' />
	<meta name="author" content="<?= $row_setting['ten_' . $lang] ?>">
	<?php if (empty($share_facebook)) {
		echo meta_data(array(
			'subject' => 'website',
			'ten' => $row_setting['title_website'],
			'thumbnail' => _upload_l . $row_setting['screenshot'],
			'seo_description' => $row_setting['description_website']
		));		
	} else { 
		echo $share_facebook;
	} ?>
	<link rel="preload" href="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" as="script">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<?php /* ?>
	<style>
		<?php
		$ch = curl_init();
		if ($mobileSite == 1){
			curl_setopt($ch, CURLOPT_URL, $url_web . "/optimize.php");
		} else {
			curl_setopt($ch, CURLOPT_URL, $url_web . "/mobile_optimize.php");
		}
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		echo $result = curl_exec($ch);
		curl_close($ch);
		?>
	</style>
	<?php */ ?>
	<link rel="stylesheet" href="css/jssor/jssor.css">
	<link rel="stylesheet/less" type="text/css" href="css/style.less?v=<?php echo time() ?>">
	<script>
		less = {
			env: "development",
			rootpath: "<?php echo $url_web ?>/",
			poll: 5000
		};
	</script>
	<script src="js/less.min.js"></script>
	<script>
		less.watch();
	</script>
	<?php 
	echo $row_setting['meta'];
	echo $row_setting['scripttop'];
	echo $row_setting['analytics'];
	?>
</head>

<body class="<?php echo "site_" . $com ?>">
	<div class="page_m">
		<header id="header" class="<?php if ($template != 'index') { ?> notindex <?php } ?>">
			<?php include _template . "layout/header.php";?>
		</header><!-- /header -->
		<!-- body -->
		<div id="body">
			<?php 
			if($template == 'index'){
				include _template."layout/slider.php";
			}
			include _template . $template . "_tpl.php";
			?>
			<!-- /body -->
		</div>
		<footer id="footer" class="<?php if ($template != 'index') { ?> notindex <?php } ?>" data-bg="url(<?php echo _upload_hinhanh_l.$bgweb['photo'] ?>)">
			<?php
			include _template . "layout/footer.php";
			?>
		</footer><!-- /footer -->
		<div id="fb-root"></div>
		<?php include _template . "layout/schema.php"; ?>
		<?php include "script.php"; ?>
	</div>
</body>
</html>