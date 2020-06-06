<?php
$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$act = explode('_', $act);
if (count($act > 1)) {
	$act = $act[1];
} else {
	$act = $act[0];
}
$config_member = false;
switch ($type) {

	case 'bat-dong-san':
	switch ($act) {
		case 'list':
		$config_noibat = false;
		$config_images = false;
		$config_auto = false;
		$title_main = "Danh mục 1";
		@define("_width_thumb", 1200);
		@define("_height_thumb", 185);
		@define("_style_thumb", 1);
		$ratio_ = 1;
		break;

		case 'cat':
		$title_main = "Danh mục 2";
		break;

		case 'item':
		$title_main = "Danh mục 3";
		break;
		
		default:

		$config_km = false; /*sp_khuyenmai*/
		$config_text_km = 'Mới';

		$config_ts = false;  /*banchay*/
		$config_text_ts = 'Bán chạy';

		$config_sale = false;  /*sp_uudai*/
		$config_text_sale = 'Mới';

		$config_bc = false;  /*sp_banchay*/
		$config_text_bc = 'Mới';

		$config_links = false;
		$title_main = "Bất động sản";
		$config_images = true;
		$config_images2 = false;
		$config_mota = true;
		$config_mota_ngan = false;
		$config_noibat = true;
		$config_text_noibat = 'Trang chủ';
		$config_mota_ckeditor = true;
		$config_ten = true;
		$config_noidung = false;
		$config_linhvuc = false;
		$config_list = true;
		$config_cat = true;
		$config_item = false;
		$config_mul = true;
		$config_name = false;
		$config_name2 = false;
		$config_thongso = false;
		$config_nhasanxuat = false;
		$br2 = false;
		$config_seo = true;
		$config_tags = false;
		@define("_width_thumb", 100);
		@define("_height_thumb", 125);
		@define("_style_thumb", 1);
		$ratio_ = 8;
		break;
	}
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	break;

	case 'binh-luan-khach-hang':
	$config_links = false;
	$title_main = "Bình luận khách hàng";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = false;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = false;
	$config_footer = false;
	@define("_width_thumb", 200);
	@define("_height_thumb", 200);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'tin-tuc':
	$config_links = false;
	$title_main = "Tin tức";
	$config_images = true;
	$config_mota = true;
	$config_noibat = true;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 250);
	@define("_height_thumb", 170);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'khung-gia-dat':
	$config_links = false;
	$title_main = "Khung giá đất";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 250);
	@define("_height_thumb", 170);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'tu-van-thiet-ke':
	$config_links = false;
	$title_main = "Tư vấn thiết kế";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 250);
	@define("_height_thumb", 170);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'ky-gui':
	$config_links = false;
	$title_main = "Ký gửi";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 250);
	@define("_height_thumb", 170);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'dich-vu':
	$config_links = false;
	$title_main = "Dịch vụ";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 250);
	@define("_height_thumb", 170);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'chinh-sach':
	$config_links = false;
	$title_main = "Chính sách";
	$config_images = true;
	$config_images_2 = false;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 150);
	@define("_height_thumb", 110);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;


	case 'y-kien-khach-hang':
	$config_links = false;
	$title_main = "Ý kiến khách hàng";
	$config_images = true;
	$config_mota = true;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = false;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = false;
	$config_footer = false;
	@define("_width_thumb", 80);
	@define("_height_thumb", 80);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;
	
	case 'gioi-thieu':
	$config_links = false;
	$title_main = "Giới thiệu";
	$config_images = true;
	$config_mul = false;
	$config_mota = false;
	$config_noibat = false;
	$config_text_noibat = 'Trang chủ';
	$config_mota_ckeditor = false;
	$config_ten = true;
	$config_noidung = true;
	$config_linhvuc = false;
	$config_list = false;
	$config_name2 = false;
	$br2 = false;
	$config_seo = true;
	$config_footer = false;
	@define("_width_thumb", 580);
	@define("_height_thumb", 395);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;


	case 'lien-he':
	$title_main = 'Liên hệ';
	$config_images = false;
	@define("_width_thumb", 580);
	@define("_height_thumb", 600);
	@define("_style_thumb", 1);
	$ratio_ = 1;
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	break;

	case 'footer':
	$title_main = 'Nội dung footer';
	break;

	case 'icon':
	$config_video = false;
	$links_ = "false";
	$title_main = 'Icon';
	$config_linhvuc = false;
	$config_image = true;
	$config_mota = true;
	$config_auto = true;
	$config_val = false;
	@define("_width_thumb", 45);
	@define("_height_thumb", 45);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;


	case 'doi-tac':
	$config_video = false;
	$links_ = "true";
	$title_main = 'Đối tác';
	$config_linhvuc = false;
	$config_image = true;
	$config_mota = false;
	$config_auto = true;
	$config_ck = false;
	$config_mul = false;
	$config_dong = false;
	@define("_width_thumb", 170);
	@define("_height_thumb", 98);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;
	
	case 'slider':
	$config_video = false;
	$links_ = "true";
	$title_main = 'Slider';
	$config_image = false;
	$config_mul = true;
	$config_linhvuc = false;
	$config_images2 = false;
	$config_mota = false;
	$config_ck = false;
	$config_dong = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 480);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'bannerqc':
	$title_main = 'Banner trái';
	$links_ = "true";
	$config_image = false;
	$config_mul = true;
	@define("_width_thumb", 202);
	@define("_height_thumb", 248);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'bannerqc2':
	$title_main = 'Banner phải';
	$links_ = "true";
	$config_image = false;
	$config_mul = true;
	@define("_width_thumb", 202);
	@define("_height_thumb", 487);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'hinh-anh':
	$title_main = 'Hình ảnh';
	$links_ = "false";
	$config_mul = true;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 412);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'video':
	$title_main = 'Video';
	$config_images = false;
	$config_video_internal = false;
	@define("_width_thumb", 785);
	@define("_height_thumb", 360);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'logo':
	$title_main = 'Logo';
	@define("_width_thumb", 140);
	@define("_height_thumb", 93);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	break;

	case 'popup':
	$links_ = "true";
	$title_main = 'Popup';
	$config_linhvuc = false;
	$config_hienthi = "true";
	@define("_width_thumb", 600);
	@define("_height_thumb", 450);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'banner':
	$title_main = 'banner';
	@define("_width_thumb", 546);
	@define("_height_thumb", 107);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'favicon':
	$title_main = 'Favicon';
	@define("_width_thumb", 512);
	@define("_height_thumb", 512);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	break;

	case 'bgweb_trang_trong':
	$title_main = "Background trang trong";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 255);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb':
	$title_main = "Background footer";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 430);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb2':
	$title_main = "Background head";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 125);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb1':
	$title_main = "Background tin tức";
	$config_option = false;
	@define("_width_thumb", 202);
	@define("_height_thumb", 340);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb2':
	$title_main = "Background head";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 110);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb3':
	$title_main = "Background tiêu chí";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 415);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'bgweb4':
	$title_main = "Background sản phẩm nổi bật";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 630);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;
	case 'bgweb5':
	$title_main = "Background thực đơn 2";
	$config_option = false;
	@define("_width_thumb", 510);
	@define("_height_thumb", 533);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;
	case 'bgweb6':
	$title_main = "Background trang trong";
	$config_option = false;
	@define("_width_thumb", 1366);
	@define("_height_thumb", 270);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_images = "true";
	$links_ = "false";
	break;

	case 'socialtop':
	$title_main = "Liên kết web";
	@define("_width_thumb", 28);
	@define("_height_thumb", 30);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 2;
	$config_images = "true";
	$config_auto = "true";
	$links_ = "true";
	break;

	case 'socialfooter':
	$title_main = "Liên kết";
	@define("_width_thumb", 27);
	@define("_height_thumb", 27);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_auto = false;
	$config_images = "true";
	$links_ = "true";
	break;

	case 'socialfooter2':
	$title_main = "Liên kết 2";
	@define("_width_thumb", 50);
	@define("_height_thumb", 50);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_auto = true;
	$config_images = "true";
	$links_ = "true";
	break;

	case 'socialfooter3':
	$title_main = "Liên kết 3";
	@define("_width_thumb", 36);
	@define("_height_thumb", 36);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_auto = true;
	$config_images = "true";
	$links_ = "true";
	break;

	case 'socialclb':
	$title_main = "Liên kết thành viên CLB";
	@define("_width_thumb", 40);
	@define("_height_thumb", 40);
	@define("_style_thumb", 1);
	@define("_img_type", 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF');
	$ratio_ = 1;
	$config_auto = true;
	$config_list = true;
	$config_images = "true";
	$links_ = "true";
	break;



	case 'method':
	$config_mota = true;
	break;

	case 'ho-tro':
	$config_social = true;
	break;


	default:
	$source = "";
	$template = "index";
	break;
}
