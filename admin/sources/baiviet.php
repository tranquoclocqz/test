<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man_list":
	get_lists();
	$template = "baiviet/list/items";
	break;
	case "add_list":		
	$template = "baiviet/list/item_add";
	break;
	case "edit_list":		
	get_list();
	$template = "baiviet/list/item_add";
	break;
	case "save_list":
	save_list();
	break;
	case "delete_list":
	delete_list();
	break;	
	#===================================================
	case "man_cat":
	get_cats();
	$template = "baiviet/cat/items";
	break;
	case "add_cat":		
	$template = "baiviet/cat/item_add";
	break;
	case "edit_cat":		
	get_cat();
	$template = "baiviet/cat/item_add";
	break;
	case "save_cat":
	save_cat();
	break;
	case "delete_cat":
	delete_cat();
	break;	
	#===================================================
	case "man_item":
	get_items();
	$template = "baiviet/item/items";
	break;
	case "add_item":		
	$template = "baiviet/item/item_add";
	break;
	case "edit_item":		
	get_item();
	$template = "baiviet/item/item_add";
	break;
	case "save_item":
	save_item();
	break;
	case "delete_item":
	delete_item();
	break;
	#===================================================
	case "man_sub":
	get_subs();
	$template = "baiviet/sub/items";
	break;
	case "add_sub":		
	$template = "baiviet/sub/item_add";
	break;
	case "edit_sub":		
	get_sub();
	$template = "baiviet/sub/item_add";
	break;
	case "save_sub":
	save_sub();
	break;
	case "delete_sub":
	delete_sub();
	break;	
	#===================================================
	case "man":
	get_mans();
	$template = "baiviet/man/items";
	break;
	case "add":		
	$template = "baiviet/man/item_add";
	break;
	case "edit":		
	get_man();
	$template = "baiviet/man/item_add";
	break;
	case "save":
	save_man();
	break;

	case "delete":
	delete_man();
	break;	
	#============================================================

	/* RSS */
	
	case "rss":
	initAddRss();	
	$template = "baiviet/item_add_rss";
	break;



	default:
	$template = "index";
}

#====================================

/* RSS */

function GetLink_HTTPS($url){

	$debug = 1;
	$fb_page_url = $url;
	$cookies = 'cookies.txt';
	touch($cookies);
	$uagent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/66.4.120 Chrome/60.4.3112.120 Safari/537.36';


		/**
			Get __VIEWSTATE & __EVENTVALIDATION
		*/
			$ch = curl_init($fb_page_url);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $uagent);

			$html = curl_exec($ch);

			curl_close($ch);

			preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
			preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);

			$viewstate = $viewstate[1];
			$eventValidation = $eventValidation[1];



		/**
			Start Fetching process
		*/
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $fb_page_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 9850);
			curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt(curl, CURLOPT_ACCEPT_ENCODING, "deflate");
		// Collecting all POST fields
			$postfields = array();
			$postfields['__EVENTTARGET'] = "Calendar1";
			$postfields['__EVENTARGUMENT'] = 5450;
			$postfields['__LASTFOCUS'] = "";
			$postfields['__VIEWSTATE'] = $viewstate;
			$postfields['__EVENTVALIDATION'] = $eventValidation;
			$postfields['drpDwnYear'] = 2017;
			$postfields['drpDwnMonth'] = "December";
			$postfields['hidStates'] = "";

		#curl_setopt($ch, CURLOPT_POST, 1);
		#curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$ret = curl_exec($ch); // Get result as fetched web page.
		
		$status = curl_getinfo($ch);
		
		if ($debug) {
			return $ret;
		}
		curl_close($ch);
	}
	
	/*---------------------------------*/
	function initAddRss()
	{
		
		global $d;
		
		include _lib."simplehtmldom/simple_html_dom.php";
		
		if (isAjaxRequest()) {
			if ($_GET['method'] == 'getlist') {
				global $feed;
				include_once  _lib."simplepie/autoloader.php";
				$feed = new SimplePie();
				$feed->set_feed_url($_POST['url']);
				$feed->enable_cache(true);
				$feed->set_cache_duration(3600);
				$feed->set_cache_location('cache');
				//start the process
				$feed->init();
				$feed->handle_content_type();
				$rss   = array();
				$i     = 0;
				//if(strpos($_POST['url'], "http://phapluattp.vn")){
				//		$url = "http://phapluattp.vn";
				//	}
				$lhost = parse_url($_POST['url']);
				
				foreach ($feed->get_items(0, 10) as $item) {
					$feed             = $item->get_feed();
					$rss[$i]['link']  = $item->get_permalink();
					$rss[$i]['name']  = $item->get_title();
					$rs               = $item->get_item_tags('', 'summaryImg');
					$rss[$i]['image'] = null;
					if (count($rs)) {
						$rss[$i]['image'] = $url . $rs[0]['data'];
					}
					if ($rss[$i]['image'] == null) {
						$rs      = $item->get_item_tags('', 'description');
						$htmlDOM = new simple_html_dom();
						$htmlDOM->load(html_entity_decode($rs[0]['data']));
						$rss[$i]['image'] = $htmlDOM->find("img", 0)->src;
						if (!filter_var($rss[$i]['image'], FILTER_VALIDATE_URL)) {
							$rss[$i]['image'] = "http://" . $lhost['host'] . trim($rss[$i]['image']);
						}
					}
					$i++;
				}
				echo json_encode($rss);
			}
			if ($_GET['method'] == 'get-item') {
				$name = magic_quote(html_entity_decode($_POST['name']));
				$url  = $_POST['url'];
				$npt = false;
				$img1  = $_POST['image'];
				$img2 = str_replace('thumb400x400','thumb600x500',$img1);
				$img3=strpos($img2,"thumb600x500");
				if($img1=='https://file1.batdongsan.com.vn/images/no-photo.jpg') //Rss không có hình
				{
					$img = $img1;
					$npt = true;
				}
				elseif($img3>0)// Rss của Tin tức
				{
					$img = $img2;
					//print_r($img);
				}
				else // Rss của Tin rao
				{
					$img = explode('/',$img1);
					unset($img[3]);
					unset($img[4]);
					$img = implode('/',$img);	
					//$img = str_replace('crop/120x90/','',$img1); // cách khác
				}
				
				$d->query("select * from #_baiviet where type='tintuc' and ten_vi='" . $name . "'");
				$data_ = array();
				if ($d->num_rows() == 1) {
					$data_['cls'] = 'red';
					$data_['stt'] = 'Tin đã tồn tại';
				} else {
					$html = str_get_html(GetLink_HTTPS($_POST['url']));
					
					$lhost = parse_url($_POST['url']);
					$type  = 0;
					
					if (($lhost['host'] == '24h.com.vn')) {
						$type = 1;
						
					}
					if (($lhost['host'] == 'gdt.gov.vn')) {
						$type = 2;
					}
					if (strpos($lhost['host'], 'vnexpress') !== false) {
						$type = 3;
					}	
					if (strpos($lhost['host'], 'batdongsan.com.vn') !== false) {
						$type = 4;
					}
					
					//echo $type;
					if ($type == 1) {
						$html = file_get_html($url);
						$content = $html->find(".text-conent",0);
						$data['ten_vi'] = (magic_quote($name));
						$data['tenkhongdau'] = changeTitle(magic_quote($name));
						$data['mota_vi'] = $html->find("p.baiviet-sapo",0)->plaintext;
						$data['photo']                                = savei($img);
						$content = $html->find(".text-conent",0);
						$data['noidung_vi']                           = magic_quote($content);
					}
					if ($type == 2) {
						$html                = $html->find("#contentWrap", 0);
						$content             = $html->find("#contentBody", 0);
						$data['ten_vi']      = (magic_quote($name));
						$data['tenkhongdau_vi'] = changeTitle(magic_quote($name));
						$data['rss']         = isset($_POST['rss']) ? 1 : 0;
						$data['mota_vi']     = strip_tags($content->find("p", 0)->innertext);
						$data['photo']       = savei($img);
						foreach ($content->find("img") as $k => $v) {
							$v->src = "http://" . $lhost['host'] . $v->src;
						}
						$data['noidung_vi'] = magic_quote($content);
					}
					if ($type == 3) {
						$content             = $html->find(".fck_detail", 0);
						$data['ten_vi']      = magic_quote($name);
						$data['tenkhongdau_vi'] = changeTitle(magic_quote($name));
						$data['rss']         = isset($_POST['rss']) ? 0 : 1;
						$data['mota_vi']     = strip_tags($html->find(".description", 0)->innertext);
						$data['photo']       = get_datatext($img);
						$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$data['ten_vi'],1);
						$data['noidung_vi']  = magic_quote($content);
					}	
					if ($type == 4) {
						$content             = $html->find("#product-detail,#ctl23_ctl00_panelNewsDetails", 0);
						$data['ten_vi']      = magic_quote($name);
						$data['tenkhongdau_vi'] = changeTitle(magic_quote($name));
						$data['rss']         = isset($_POST['rss']) ? 0 : 1;
						$data['mota_vi']     = strip_tags($html->find(".pm-desc,.detailsView-contents-style", 0)->innertext);
						$data['photo']       = get_datatext($img);
						$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$data['ten_vi'],1);
						$data['noidung_vi']  = magic_quote($content);
					}
					
					$data['hienthi'] = 1;
					$data['ngaytao'] = time();
					$data['type'] = 'tintuc';
					
					$d->setTable("baiviet");
					
					
					if ($d->insert($data)) {
						$data_['cls'] = 'green';
						$data_['stt'] = 'Thêm thành công';
					}
					
					$html->clear();
					unset($html);
				}
				echo json_encode($data_);
			}
			die();
		}
	}
	function savei($y)
	{
		
		$arry = end(explode(".", $y));
		$a    = explode("?", $arry);
		$b    = $a[0];
		$img  = rand(0, 9999) . "." . $b;
		return save_image($y,$img);
		
	}
	
	function get_datatext($url){ 
		
		return savei($url);
	}
	
	function save_image($image_url, $image_file){
		
		$fp = fopen (_upload_baiviet.$image_file, 'w+');              // open file handle
		
		$ch = curl_init($image_url);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
		curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
		// curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
		curl_exec($ch);
		
		curl_close($ch);                              // closing curl handle
		fclose($fp);                                  // closing file handle
		return $image_file;
	}
	

	/* /RSS */

	function get_mans(){
		global $d, $items, $paging,$page;

	#----------------------------------------------------------------------------------------
		if($_REQUEST['banchay']!='')
		{
			$id_up = $_REQUEST['banchay'];
			$sql_sp = "SELECT id,banchay FROM table_baiviet where id='".$id_up."' ";
			$d->query($sql_sp);
			$cats= $d->result_array();
			$time=time();
			$hienthi=$cats[0]['banchay'];
			if($hienthi==0)
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET banchay =1 WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}
			else
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET banchay =0  WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}	
		}
	#----------------------------------------------------------------------------------------
		if($_REQUEST['noibat']!='')
		{
			$id_up = $_REQUEST['noibat'];
			$sql_sp = "SELECT id,noibat FROM table_baiviet where id='".$id_up."' ";
			$d->query($sql_sp);
			$cats= $d->result_array();
			$time=time();
			$hienthi=$cats[0]['noibat'];
			if($hienthi==0)
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET noibat =1 WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}
			else
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET noibat =0  WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}	
		}
	#-------------------------------------------------------------------------------

	#----------------------------------------------------------------------------------------
		if($_REQUEST['hienthi']!='')
		{
			$id_up = $_REQUEST['hienthi'];
			$sql_sp = "SELECT id,hienthi FROM table_baiviet where id='".$id_up."' ";
			$d->query($sql_sp);
			$cats= $d->result_array();
			$hienthi=$cats[0]['hienthi'];
			if($hienthi==0)
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET hienthi =1 WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}
			else
			{
				$sqlUPDATE_ORDER = "UPDATE table_baiviet SET hienthi =0  WHERE  id = ".$id_up."";
				$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
			}	
		}
	#-------------------------------------------------------------------------------


	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_baiviet ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}
	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc = ".$_GET['id_linhvuc'];
	}
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat,id_item,id_sub,banchay,footer,id_linhvuc,photo from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man&type=".$_GET['type']."".$link_add."&type=".$_GET['type'];
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);	
	$sql = "select * from #_baiviet where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();	

	$sql = "select * from #_baiviet_photo where id_baiviet='".$id."' and type='".$_GET['type']."' order by stt,id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
}

function save_man(){
	global $d,$ar_lang,$br2;
	$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
	$file_name_2 = changeTitle($_POST['ten_vi']).'_2-'.rand(0,9999);
	$file_name_baogia = images_name($_FILES['file_baogia']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_linhvuc'] = (int)$_POST['id_linhvuc'];
	$data['id_list'] = (int)$_POST['id_list'];
	$data['id_cat'] = (int)$_POST['id_cat'];
	$data['id_item'] = (int)$_POST['id_item'];
	$data['id_sub'] = (int)$_POST['id_sub'];
	$data['color'] = $_POST['color'];
	$data['link'] = $_POST['link'];
	if($_POST['tags']){
		$data['tags'] = implode(',',$_POST['tags']);
	}
	foreach ($ar_lang as $key => $value) {
		$data['name_'.$value['slug']] = $_POST['name_'.$value['slug']];
		$data['name2_'.$value['slug']] = $_POST['name2_'.$value['slug']];
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['noidung_'.$value['slug']] = magic_quote($_POST['noidung_'.$value['slug']]);
		$data['mota_'.$value['slug']] = ($br2) ? nl2br2(strip_tags($_POST['mota_'.$value['slug']])) : magic_quote($_POST['mota_'.$value['slug']]);
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}	
	$data['tenkhongdau'] = ($_POST['tenkhongdau']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	
	if($id){
		$data['ngaysua'] = time();
		if($photo = upload_image("file_2", _img_type, _upload_baiviet,$file_name_2)){
			$data['photo_2'] = $photo;
			$data['thumb_2'] = create_thumb($data['photo_2'], 30, 30, _upload_baiviet,$file_name_2,1);
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo_2']);	
				delete_file(_upload_baiviet.$row['thumb_2']);				
			}
		}

		if($photo = upload_image("file", _img_type, _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			if($_GET['type'] != 'goctuvan'){
				$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
			}
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);	
				delete_file(_upload_baiviet.$row['thumb']);				
			}
		}

		if($filebaogia = upload_image("file_baogia", 'pdf|doc|docx|xls|xlsx|XLS|XLSX|DOC|DOCX|PDF', _upload_files,$file_name_baogia)){
			$data['file_baogia'] = $filebaogia;
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_files.$row['file_baogia']);	
			}
		}
		$d->setTable('baiviet');
		$d->setWhere('id', $id);
		if($d->update($data)){			
			if (isset($_FILES['files'])) {
				for($i=0;$i<count($_FILES['files']['name']);$i++){
					if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
						$file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);	
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['mota'] = $_POST['mota'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_baiviet'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('baiviet_photo');
						$d->insert($data1);

					}
				}
			}

			redirect($_SESSION['links_re']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		
		$data['ngaytao'] = time();
		if($photo = upload_image("file", _img_type, _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			if($_GET['type'] != 'goctuvan'){		
				$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
			}
		}	

		if($photo = upload_image("file_2", _img_type, _upload_baiviet,$file_name_2)){
			$data['photo_2'] = $photo;
			$data['thumb_2'] = create_thumb($data['photo_2'], 30, 30, _upload_baiviet,$file_name_2,1);
		}

		if($filebaogia = upload_image("file_baogia", 'pdf|doc|docx|xls|xlsx|XLS|XLSX|DOC|DOCX|PDF', _upload_files,$file_name_baogia)){
			$data['file_baogia'] = $filebaogia;
		}
		$d->setTable('baiviet');
		// for ($i=0; $i < 9; $i++) { 
		// 	if($d->insert($data)){}
		// }
		if($d->insert($data)){
			$id = mysql_insert_id();
			if (isset($_FILES['files'])) {
				for($i=0;$i<count($_FILES['files']['name']);$i++){
					if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
						$file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);	
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['mota'] = $_POST['mota'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_baiviet'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('baiviet_photo');
						$d->insert($data1);

					}
				}
			}
			redirect($_SESSION['links_re']);
		}
		else{
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
		}
	}
}
function delete_man(){
	global $d;


	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_photo where id_baiviet='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_baiviet.$photo_lq[$i]['photo']);
				delete_file(_upload_baiviet.$photo_lq[$i]['thumb']);
			}
		}
		$sql = "delete from #_baiviet_photo where id_baiviet='".$id."'";
		$d->query($sql);


		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){

			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_photo where id_baiviet='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($j=0;$j<count($photo_lq);$j++){
					delete_file(_upload_baiviet.$photo_lq[$j]['photo']);
					delete_file(_upload_baiviet.$photo_lq[$j]['thumb']);
				}
			}
			$sql = "delete from #_baiviet_photo where id_baiviet='".$id."'";
			$d->query($sql);

			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}


}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_baiviet_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_list SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_list SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_baiviet_list ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_linhvuc']!='')
	{
		$id=addslashes($_REQUEST['id_linhvuc']);
		$where.=" and id_linhvuc = ".$id;
	}
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,noibat,footer,id_linhvuc,photo from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
	$url = "index.php?com=baiviet&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_baiviet_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_list(){
	global $d,$ar_lang;
	$file_name = changeTitle($_POST['ten_vi']).'-'.rand(0,9999);
	$file_quangcao=images_name($_FILES['file']['quangcao']);	
	$file_quangcao2=images_name($_FILES['file']['quangcao2']);	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";	
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['name_'.$value['slug']] = $_POST['name_'.$value['slug']];
		$data['noidung_'.$value['slug']] = $_POST['noidung_'.$value['slug']];
		$data['mota_'.$value['slug']] = $_POST['mota_'.$value['slug']];
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}	
	$data['id_linhvuc'] = (int)$_POST['id_linhvuc'];
	$data['links'] = $_POST['links'];
	$data['tenkhongdau'] = ($_POST['tenkhongdau']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;	
	$data['type'] = $_GET['type'];
	if($id){
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);	
			$d->setTable('baiviet_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
			}
		}
		if($photo = upload_image("quangcao", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_quangcao)){
			$data['quangcao'] = $photo;
			$d->setTable('baiviet_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['quangcao']);
			}
		}
		if($photo = upload_image("quangcao2", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_quangcao2)){
			$data['quangcao2'] = $photo;
			$d->setTable('baiviet_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['quangcao2']);
			}
		}
		$d->setTable('baiviet_list');
		$d->setWhere('id', $id);
		if($d->update($data)){			
			redirect($_SESSION['links_re']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		$data['ngaytao'] = time();
		if($photo = upload_image("file", _img_type, _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);	
		}
		if($photo = upload_image("quangcao", _img_type, _upload_baiviet,$file_quangcao)){
			$data['quangcao'] = $photo;
		}
		if($photo = upload_image("quangcao2", _img_type, _upload_baiviet,$file_quangcao2)){
			$data['quangcao2'] = $photo;
		}
		$d->setTable('baiviet_list');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_baiviet_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_list where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_baiviet_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}

#=================cat===================

function get_cats(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_baiviet_cat where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_cat SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_cat SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_baiviet_cat ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}

	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc=".$_REQUEST['id_linhvuc'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,noibat,id_linhvuc,photo from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_cat(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_baiviet_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$ar_lang;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['mota_'.$value['slug']] = $_POST['mota_'.$value['slug']];
		$data['noidung_'.$value['slug']] = $_POST['noidung_'.$value['slug']];
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}			
	$data['id_list'] =(int) $_POST['id_list'];
	$data['id_linhvuc'] = (int)$_POST['id_linhvuc'];
	$data['tenkhongdau'] = ($_POST['tenkhongdau']);
	$data['stt'] = $_POST['stt'];
	$data['type'] = $_GET['type'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
			$d->setTable('baiviet_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
			}
		}
		$d->setTable('baiviet_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
		}
		$data['ngaytao'] = time();		
		$d->setTable('baiviet_cat');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_cat(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_cat where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_cat where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#=================Item===================

function get_items(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_baiviet_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_item SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_item SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=baiviet&act=man_item&type=".$_GET['type'];
	
	$where = " #_baiviet_item ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}

	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc=".$_REQUEST['id_linhvuc'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,id_linhvuc from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man_item&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_baiviet_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$ar_lang;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}	
	$data['tenkhongdau'] = changeTitle($_POST['tenkhongdau']);
	$data['id_list'] = (int)$_POST['id_list'];
	$data['id_linhvuc'] = (int)$_POST['id_linhvuc'];
	$data['id_cat'] = (int)$_POST['id_cat'];
	$data['type'] = $_GET['type'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
			$d->setTable('baiviet_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
			}
		}
		$d->setTable('baiviet_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		$data['ngaytao'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
		}
		$d->setTable('baiviet_item');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_item where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_item where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#=================Sub===================

function get_subs(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_baiviet_sub where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_sub SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_baiviet_sub SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = $d->query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=baiviet&act=man_sub&type=".$_GET['type'];
	
	$where = " #_baiviet_sub ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item=".$_REQUEST['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_linhvuc']!='')
	{
		$where.=" and id_linhvuc=".$_REQUEST['id_linhvuc'];
	}
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,id_item,id_linhvuc from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man_sub&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_sub(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer($_SESSION['links_re']);
	
	$sql = "select * from #_baiviet_sub where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_sub(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_sub&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	$id =  themdau($_POST['id']);		
	foreach ($ar_lang as $key => $value) {
		$data['ten_'.$value['slug']] = $_POST['ten_'.$value['slug']];
		$data['title_'.$value['slug']] = !empty($_POST['title_'.$value['slug']]) ? $_POST['title_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['keywords_'.$value['slug']] = !empty($_POST['keywords_'.$value['slug']]) ? $_POST['keywords_'.$value['slug']] : $_POST['ten_'.$value['slug']];
		$data['description_'.$value['slug']] = !empty($_POST['description_'.$value['slug']]) ? $_POST['description_'.$value['slug']] : $_POST['ten_'.$value['slug']];
	}	
	$data['id_linhvuc'] = (int)$_POST['id_linhvuc'];
	$data['id_list'] = (int)$_POST['id_list'];
	$data['id_cat'] = (int)$_POST['id_cat'];
	$data['id_item'] = (int)$_POST['id_item'];
	$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){
		$data['ngaysua'] = time();
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);	
			$d->setTable('baiviet_sub');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);	
				delete_file(_upload_baiviet.$row['thumb']);				
			}
		}
		$d->setTable('baiviet_sub');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_baiviet,$file_name,_style_thumb);
		}	
		$data['ngaytao'] = time();
		$d->setTable('baiviet_sub');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_sub(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_sub where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_sub where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_sub where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_sub where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#====================================



?>