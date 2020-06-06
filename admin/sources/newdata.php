<?php die;
$logo = _fetch_array("SELECT photo_$lang as photo FROM table_photo WHERE type like 'slider' LIMIT 0,1");
$my_logo = 'thumbnail.jpg';
$arrayCom = array(
	array('com' =>'bat-dong-san','title'=>'Bất động sản','id'=>'idl','type'=>'bat-dong-san','priority'=>'0.80'),
	array('com' =>'tin-tuc','title'=>'Tin tức','id'=>'id','type'=>'tin-tuc','priority'=>'0.80'),
	array('com' =>'khung-gia-dat','title'=>'Khung giá đất','id'=>'id','type'=>'khung-gia-dat','priority'=>'0.80'),
	array('com' =>'tu-van-thiet-ke','title'=>'Tư vấn thiết kế','id'=>'id','type'=>'tu-van-thiet-ke','priority'=>'0.80'),
	array('com' =>'ky-gui','title'=>'Ký gửi','id'=>'id','type'=>'ky-gui','priority'=>'0.80'),
	array('com' =>'dich-vu','title'=>'Dịch vụ','id'=>'id','type'=>'dich-vu','priority'=>'0.80'),
	array('com' =>'thu-vien','title'=>'Thư viện','id'=>'id','type'=>'gioi-thieu','priority'=>'0.80'),
	array('com' =>'tim-kiem','title'=>'Tìm kiếm','id'=>'id','type'=>'gioi-thieu','priority'=>'0.80'),
);
$row_setting=_fetch_array("select * from #_setting limit 0,1");
$input = unique_multi_array($arrayCom,'com');
foreach($input as $value){
	$title = $value['title'].' | '.$row_setting['ten_vi'];
	$keywords = $value['title'].' , '.$row_setting['ten_vi'];
	$description = $value['title'].' '.$row_setting['description_website'];
	$data['type'] = "page-info-".$value['com'];
	$data['title'] = magic_quote($title);
	$data['keywords'] = magic_quote($keywords);
	$data['description'] = magic_quote($description);
	$data['photo'] = $my_logo;
	$d->setTable('tieude');
	if ($d->insert($data)) {
		continue;
	}
}

die;
$r = range(1,22);
$i = 1;
foreach (range(1,1920) as $key => $value) {
	$d->query("UPDATE table_product set photo = 'cat-".$r[$i].".png',thumb = 'cat-".$r[$i].".png' WHERE id='".$value."' ");
	$i++;
	if ($i == 22) {
		$i = 1;
		shuffle($r);
	}
}
/*die;

$i = 1;
foreach (range(44,123) as $key => $value) {
	$d->query("UPDATE table_baiviet set photo = 'l".$i.".jpg',thumb = 'l".$i.".jpg' WHERE id='".$value."' ");
	$i++;
	if ($i == 30) {
		$i = 1;
	}
}
$j = 1;
foreach (range(44,123) as $key => $value) {

	$r = range(1,29);
	shuffle($r);
	for ($i=0; $i < 10; $i++) { 
		$d->query("INSERT into table_baiviet_photo(photo,thumb,id_baiviet,type) values ('l".$r[$j].".jpg','l".$r[$j].".jpg','".$value."','cong-trinh-thi-cong')");
		$j++;
		if ($j == 10) {
			$j = 1;
		}
	}
}
/*

/*
$arrayCom = array(
	array('com' =>'vi-sao-chon-chung-toi','title'=>'Vì sao chọn chúng tôi'),
	array('com' =>'tin-tuc','title'=>'Tin tức'),
	array('com' =>'bang-gia','title'=>'Bảng giá'),
	array('com' =>'phong-thuy','title'=>'Phong thủy'),
	array('com' =>'thiet-ke','title'=>'Thiết kế'),
	array('com' =>'thi-cong','title'=>'Thi công'),
	array('com' =>'lien-he','title'=>'Liên hệ'),
	array('com' =>'tim-kiem','title'=>'Tìm kiếm'),
);
$row_setting=_fetch_array("select * from #_setting limit 0,1");
$input = unique_multi_array($arrayCom,'com');
foreach($input as $value){
	$title = $value['title'].' | '.$row_setting['ten_vi'];
	$keywords = $value['title'].' , '.$row_setting['ten_vi'];
	$description = $value['title'].' '.$row_setting['ten_vi'];
	$data['type'] = "page-info-".$value['com'];
	$data['title'] = magic_quote($title);
	$data['keywords'] = magic_quote($keywords);
	$data['description'] = magic_quote($description);
	$d->setTable('tieude');
	if ($d->insert($data)) {
		continue;
	}
}
$i = 1;
foreach (range(1,50) as $key => $value) {
	$d->query("UPDATE table_baiviet set photo = 'cat-".$i.".jpg',thumb = 'cat-".$i.".jpg' WHERE id='".$value."' ");
	$i++;
	if ($i == 23) {
		$i = 1;
	}
}
/*
$j = 1;
foreach (range(1,1920) as $key => $value) {
	for ($i=0; $i < 10; $i++) { 
		$d->query("INSERT into table_product_photo(photo,thumb,id_product) values ('cat-".$j.".png','cat-".$j.".png','".$value."')");
		$j++;
		if ($j == 13) {
			$j = 1;
		}
	}
}
$danh_muc_1 = _result_array("SELECT id from table_product_list");
foreach ($danh_muc_1 as $key => $value) {
	$danh_muc_2 = _result_array("SELECT id from table_product_cat where id_list = '".$value['id']."'");
	foreach ($danh_muc_2 as $key2 => $value2) {
		$danh_muc_3 = _result_array("SELECT id from table_product_item where id_cat = '".$value2['id']."'");
		foreach ($danh_muc_3 as $key3 => $value3) {
			for ($i = 0; $i < 10; $i++) {
				$data['ten_vi'] = 'Sản phẩm';
				$data['tenkhongdau'] = changeTitle($data['ten_vi']);
				$data['type'] = 'san-pham';
				$data['giaban'] = 100000;
				$data['giacu'] = 100000;
				$data['hienthi'] = 1;
				$data['id_list'] = $value['id'];
				$data['id_cat'] = $value2['id'];
				$data['id_item'] = $value3['id'];
				$data['mota_vi'] = 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500';
				$data['noidung_vi'] = '<h3>Đoạn Lorem Ipsum chuẩn, được sử dụng từ những năm 1500</h3> <p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p> <h3>Đoạn 1.10.32 trong &quot;De Finibus Bonorum et Malorum&quot; viết bởi Cicero năm 45 trước C&ocirc;ng Nguy&ecirc;n</h3> <p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p> <h3>Một đoạn dịch của H. Rackham năm 1914</h3> <p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p> <h3>Đoạn 1.10.33 trong &quot;De Finibus Bonorum et Malorum&quot; viết bởi Cicero năm 45 trước C&ocirc;ng Nguy&ecirc;n</h3> <p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p> <h3>Một đoạn dịch của H. Rackham năm 1914</h3> <p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p> ';
				$d->setTable('product');
				$d->insert($data);
			}
		}
	}
}

*//*
$range = array('Tân Châu','Tân Biên','Gò Dầu','Dương Minh Châu','Bến Cầu','Trảng Bàng','Thành phố Tây Ninh','Châu Thành');
$range2 = range('1','4');
foreach ($range as $key => $value) {
	$data['ten_vi'] = ($value);
	$data['ten_en'] = ($value);
	$data['name_en'] = $value;
	$data['name_vi'] = $value;
	$data['ngaytao'] = time();
	$data['ngaysua'] = time();
	$data['tenkhongdau'] = changeTitle($data['ten_vi']);
	$data['type'] = 'dich-vu';
	$data['hienthi'] = 1;
	$data['stt'] = $key + 1;
	$d->setTable("baiviet_list");
	if($d->insert($data)) {
		$idl = mysql_insert_id();
		foreach ($range2 as $key2 => $value2) {
			$data1['ten_vi'] = ($value.' '.$value2);
			$data1['ten_en'] = ($value.' '.$value2);
			$data1['tenkhongdau'] = changeTitle($data1['ten_vi']);
			$data1['type'] = 'dich-vu';
			$data1['id_list'] = $idl;
			$data1['hienthi'] = 1;
			$data1['stt'] = $key2 + 1;
			$d->setTable("baiviet_cat");
			if($d->insert($data1)){
				$idc = mysql_insert_id();
				foreach ($range2 as $key3 => $value3) {
					$data2['ten_vi'] = $value.' '.$value2.' '.$value3;
					$data2['ten_en'] = $value.' '.$value2.' '.$value3.' E';
					$data2['tenkhongdau'] = changeTitle($data2['ten_vi']);
					$data2['type'] = 'dich-vu';
					$data2['id_list'] = $idl;
					$data2['id_cat'] = $idc;
					$data2['hienthi'] = 1;
					$data2['stt'] = $key3 + 1;
					$d->setTable("baiviet_item");
					if($d->insert($data2)){
						$idi = mysql_insert_id();
						foreach ($range2 as $key4 => $value4) {
							$data3['ten_vi'] = $value.' '.$value2.' '.$value3.' '.$value4;
							$data3['ten_en'] = $value.' '.$value2.' '.$value3.' '.$value4.' E';
							$data3['type'] = 'dich-vu';
							$data3['tenkhongdau'] = changeTitle($data3['ten_vi']);
							$data3['id_list'] = $idl;
							$data3['id_cat'] = $idc;
							$data3['id_item'] = $idi;
							$data3['hienthi'] = 1;
							$data3['stt'] = $key4 + 1;
							$d->setTable("baiviet_sub");
							$d->insert($data3);
						}
					}
				}
			}
		}
	}
}
die();