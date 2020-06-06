<?php
$row_setting = _fetch_array("select * from #_setting limit 0,1");
$favicon = _fetch_array("select photo_$lang as thumb from #_photo where type='favicon'");
$logo = _fetch_array("SELECT photo_vi as photo FROM table_photo WHERE type like 'logo' LIMIT 0,1");
$banner = _fetch_array("SELECT photo_vi as photo FROM table_photo WHERE type like 'banner' LIMIT 0,1");
$bgweb = _fetch_array("SELECT photo from table_bgweb where type like 'bgweb'");
$bgweb2 = _fetch_array("SELECT photo from table_bgweb where type like 'bgweb2'");
$danh_muc_san_pham = _result_array("SELECT noibat,id,ten_$lang as ten,photo,tenkhongdau from table_product_list where type like 'bat-dong-san' and hienthi = 1 order by stt asc,id desc");
$footer = _fetch_array("SELECT noidung_$lang as noidung from table_company where type like 'footer'");
$socialfooter = _result_array("SELECT ten,photo,url from table_lkweb where type like 'socialfooter' and hienthi = 1 order by stt asc,id desc");
$socialtop = _result_array("SELECT ten,photo,url from table_lkweb where type like 'socialtop' and hienthi = 1 order by stt asc,id desc");
if (isset($_POST['btn-send2'])) {
	if ($config['google_recaptcha_v3']) {
		include _lib . "check_google_recaptcha_v3.php";
	}
	$txt_ten 			= magic_quote($_POST['txt_ten']);
	$txt_dienthoai 		= magic_quote($_POST['txt_dienthoai']);
	$txt_email 			= magic_quote($_POST['txt_email']);
	$txt_diachi 		= magic_quote($_POST['txt_diachi']);
	$txt_noidung 		= magic_quote($_POST['txt_noidung']);
	$txt_tieude 		= magic_quote($_POST['txt_tieude']);
	$txt_ngaydat 		= magic_quote($_POST['txt_ngaydat']);
	$txt_thoigian 		= magic_quote($_POST['txt_thoigian']);
	$field 				= '';
	$field 				.= !empty($txt_ten) ? '<tr> <td style="width: 110px"><strong>Tên: </strong></td> <td>' . ($txt_ten) . '</td> </tr>' : '';

	$field 				.= !empty($txt_dienthoai) ? '<tr> <td style="width: 110px"><strong>Điện thoại: </strong></td> <td>' . ($txt_dienthoai) . '</td> </tr>' : '';

	$field 				.= !empty($txt_email) ? '<tr> <td style="width: 110px"><strong>Email: </strong></td> <td>' . ($txt_email) . '</td> </tr>' : '';

	$field 				.= !empty($txt_tieude) ? '<tr> <td style="width: 110px"><strong>Món đặt: </strong></td> <td>' . ($txt_tieude) . '</td> </tr>' : '';

	$field 				.= !empty($txt_diachi) ? '<tr> <td style="width: 110px"><strong>Địa chỉ: </strong></td> <td>' . ($txt_diachi) . '</td> </tr>' : '';

	$field 				.= !empty($txt_noidung) ? '<tr> <td style="width: 110px"><strong>Nội dung: </strong></td> <td>' . ($txt_noidung) . '</td> </tr>' : '';


	if (!empty($_SESSION['wishlist'])) {
		$field .= '<tr> <td style="width: 110px;vertical-align:top"><strong>Món ăn: </strong></td> <td>';
			$r = _result_array("SELECT ten_vi as ten,id,tenkhongdau from table_product where id in ('".implode("','",array_map('mysql_real_escape_string', $_SESSION['wishlist']))."')");
			foreach ($r as $key => $value) {
				$field .= ' <a href="'.$url_web.'/'.$value['tenkhongdau'].'">'.$value['ten'].'</a>, ';
			}
		$field .= '</td> </tr>';		
	}

	$field 				.= !empty($txt_diachi) ? '<tr> <td style="width: 110px"><strong>Địa chỉ: </strong></td> <td>' . ($txt_diachi) . '</td> </tr>' : '';


	$field 				.= !empty($txt_noidung) ? '<tr> <td style="width: 110px"><strong>Nội dung: </strong></td> <td>' . ($txt_noidung) . '</td> </tr>' : '';

	$body = '
	<table style="width:100%;border-collapse:collapse;font-size: 12px;color: #333;font-family: Tahoma">
		<tbody>
			<tr>
				<td align="center">
					<table style="width: 100%;max-width: 650px;border-collapse:collapse; font-size: 12px;color: #333;font-family: Tahoma;line-height: 18px">
						<tbody>
							<!-- banner -->
							<tr>
								<td colspan="3" style="padding: 0;text-align: center; display: table-cell;vertical-align: middle">
									<a href="' . $url_web . '">
										<img src="' . $url_web . '/' . _upload_hinhanh_l . $logo['photo'] . '" alt="' . $row_setting['ten_vi'] . '">
									</a>
								</td>
							</tr>
							<!-- #banner -->
							<tr>
								<td colspan="3">
								<br/>
									Kính gửi ' . $txt_email . ' !<br/>
									Cám ơn bạn đã quan tâm tới công ty của chúng tôi !<br/>
									Thông tin của bạn:<br/><br/>
									<table style="margin-bottom: 25px;width: 100%;max-width: 650px;border-collapse:collapse; font-size: 12px;color: #333;font-family: Tahoma;line-height: 18px">
										<tbody>
											' . $field . '
										</tbody>
									</table>
									Chúng tôi sẽ liên lạc với bạn sớm nhất có thể.<br/>
									Trân trọng,<br/>
									' . $row_setting['ten_vi'] . '
								</td>
							</tr>
							<!-- info -->
							<tr>
								<td>
									<table style="width: 100%;font-size: 12px;color: #333;font-family: Tahoma; margin-top: 35px;background: #e9e9e9;line-height: 18px;padding: 20px">
										<tbody>
											<tr>
												<td style="padding: 0 0 3px 0;font-size: 18px;"><strong>' . $row_setting['ten_vi'] . '</strong></td>
											</tr>
											<tr><td style="padding: 0 0 3px 0">Đ/c: ' . ($row_setting['diachi_vi']) . '</td></tr>
											<tr><td style="padding: 0">Tel: ' . $row_setting['dienthoai'] . '</td></tr>
											<tr><td style="padding: 0">Email: <a style="color: #e50000" href="mailto:' . $row_setting['email'] . '">' . $row_setting['email'] . '</a></td></tr>
										</tbody>
									</table>
								</td>
							</tr>
							<!-- #info -->
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	';

	$config_send_mail = array(
		'config_ip'		=> $config_ip,
		'config_email'	=> $config_email,
		'config_pass'	=> $config_pass,
		'setfrom' 		=> array('email' => $config_email, 'title' => 'Thư liên hệ ' . $row_setting['ten_vi']),
		'addAddress' 	=> array(
			array('email' => $row_setting['email'], 'title' => 'Thư liên hệ ' . $row_setting['ten_vi']),
		),
		'subject'		=> 'Thư liên hệ ' . $row_setting['ten_vi'],
	);
	if (filter_var($txt_email, FILTER_VALIDATE_EMAIL)) {
		array_push($config_send_mail['addAddress'], array('email' => $txt_email, 'title' => 'Thư liên hệ ' . $row_setting['ten_vi']));
	}
	if (fnc_sendMail($config_send_mail, $body)) {
		$sp = implode(",",array_map('mysql_real_escape_string', $_SESSION['wishlist']));
		$d->reset();
		$data['ten'] 		= $txt_ten;
		$data['diachi'] 	= $txt_diachi;
		$data['dienthoai'] 	= $txt_dienthoai;
		$data['email'] 		= $txt_email;
		$data['noidung']	= $txt_noidung;
		$data['tieude']		= $txt_tieude;
		$data['ngaytao'] 	= time();
		$d->setTable('newsletter');
		$d->insert($data);
		unset($_SESSION['wishlist']);
		transfer('Gửi mail thành công', $url_web);
	} else {
		transfer('Gửi mail thất bại', $url_web . '');
	}
}
