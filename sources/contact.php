<?php if (!defined('_source')) die("Error");
$breadcrumb = breadcrumb(array(
	'last' => $title_detail_frq
));
$row_detail = _fetch_array("select photo,noidung_$lang as noidung from #_company where type='$type_bar' ");
$share_result = _fetch_array("SELECT ten_vi as ten,mota,photo,title,keywords,description from table_tieude where type like 'page-info-" . $com . "'");
if (!empty($share_result)) {
	$title_bar .= $share_result['title'];
	$keywords_bar .= $share_result['keywords'];
	$description_bar .= $share_result['description'];
	$meta_data = array(
		'subject' => 'contact',
		'ten' => $share_result['title'],
		'thumbnail' => _upload_hinhanh_l.$share_result['photo'],
		'seo_description' => $share_result['description']
	);
	$share_facebook = meta_data($meta_data);
}
if (isset($_POST['btn-send'])) {
	if ($config['google_recaptcha_v3']) {
		include lib . "check_google_recaptcha_v3.php";
	}
	$txt_diachi 	= mysql_real_escape_string($_POST['txt_diachi']);
	$txt_ten 		= mysql_real_escape_string($_POST['txt_ten']);
	$txt_dienthoai 	= mysql_real_escape_string($_POST['txt_dienthoai']);
	$txt_email 		= mysql_real_escape_string($_POST['txt_email']);
	$txt_noidung 	= mysql_real_escape_string($_POST['txt_noidung']);
	$field 			= '';
	$field 			.= !empty($txt_ten) ? '<tr> <td style="width: 80px"><strong>Tên: </strong></td> <td>' . $txt_ten . '</td> </tr>' : '';
	$field 			.= !empty($txt_ten) ? '<tr> <td style="width: 80px"><strong>Địa chỉ: </strong></td> <td>' . $txt_diachi . '</td> </tr>' : '';
	$field 			.= !empty($txt_dienthoai) ? '<tr> <td style="width: 80px"><strong>Điện thoại: </strong></td> <td>' . $txt_dienthoai . '</td> </tr>' : '';
	$field 			.= !empty($txt_email) ? '<tr> <td style="width: 80px"><strong>Email: </strong></td> <td>' . $txt_email . '</td> </tr>' : '';
	$field 			.= !empty($txt_noidung) ? '<tr> <td style="width: 80px"><strong>Nội dung: </strong></td> <td>' . $txt_noidung . '</td> </tr>' : '';
	$field 			.= isset($_GET['product']) ? '<tr> <td style="width: 80px"><strong>Sản phẩm: </strong></td> <td><a href="' . $url_web . '/san-pham/' . $getsanpham['tenkhongdau'] . '.html">' . $getsanpham['ten'] . '</a></td> </tr>' : '';
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
									Kính gửi ' . $txt_ten . ' !<br/>
									Cám ơn bạn đã quan tâm tới công ty của chúng tôi !<br/>
									Thông tin liên hệ của bạn:<br/><br/>
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
											<tr><td style="padding: 0 0 3px 0">' . ($row_setting['diachi_vi']) . '</td></tr>
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
			array('email' => $txt_email, 'title' => 'Thư liên hệ ' . $row_setting['ten_vi']),
			array('email' => $row_setting['email'], 'title' => 'Thư liên hệ ' . $row_setting['ten_vi']),
		),
		'subject'		=> 'Thư liên hệ ' . $row_setting['ten_vi'],
	);
	if (fnc_sendMail($config_send_mail, $body)) {
		$d->reset();
		$data['ten'] 		= $txt_ten;
		$data['diachi'] 	= $txt_diachi;
		$data['dienthoai'] 	= $txt_dienthoai;
		$data['email'] 		= $txt_email;
		$data['noidung']	= $txt_noidung;
		$data['id_product']	= $_GET['product'];
		$data['ngaytao'] = time();
		$data['type'] = 'lien-he';
		$d->setTable('contact');
		$d->insert($data);
		transfer("Gửi mail thành công", $url_web);
	} else {
		transfer("Gửi mail thất bại", $url_web);
	}
}
