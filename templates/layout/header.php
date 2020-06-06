<div class="block-head" data-bg="url(<?php echo _upload_hinhanh_l.$bgweb2['photo'] ?>)">
	<div class="container">
		<div class="logo">
			<a href="<?php echo $url_web ?>">
				<img data-src="<?php echo _upload_hinhanh_l.$logo['photo'] ?>" alt="<?php echo $row_setting['ten_'.$lang] ?>" class="img-responsive" width="140" height="93">
			</a>
		</div>
		<div class="banner">
			<a href="<?php echo $url_web ?>">
				<img data-src="<?php echo _upload_hinhanh_l.$banner['photo'] ?>" alt="<?php echo $row_setting['ten_'.$lang] ?>" class="img-responsive" width="546" height="107">
			</a>
		</div>
		<div class="block-head-right">
			<div class="socialtop">
				<?php foreach($socialtop as $key => $value) { ?>
					<a href="<?php echo $value['url'] ?>"><img data-src="<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>"></a>
				<?php } ?>
			</div>
			<div class="hotline">
				<img src="images/hotline.png" alt="hotline">
				Hotline: <a href="<?php echo replace_sodienthoai($row_setting['hotline']) ?>"><?php echo $row_setting['hotline'] ?></a>
			</div>
		</div>
	</div>
</div>
<div id="fix">
	<div class="block-menu">
		<div class="container">
			<a href="#mmenu" id="btn-open-mmenu">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</a>
			<nav id="clone">
				<ul class="primary-menu">
					<li <?php echo $classActive = ($template == 'index') ? 'class="active"' : '' ?> id="home"><a href="<?php echo SITE_URI ?>"><img src="images/home.png" alt="Trang chủ"></a></li>
					<li <?php echo $classActive = ($com == 'gioi-thieu') ? 'class="active"' : '' ?>><a href="gioi-thieu">Giới thiệu</a></li>
					<?php if(!empty($danh_muc_san_pham)) { ?>
						<?php foreach( $danh_muc_san_pham as $key => $value ){ 
							$cap2 = _result_array("SELECT ten_$lang as ten,id,tenkhongdau from table_product_cat where type like 'bat-dong-san' and hienthi = 1 and id_list = '".$value['id']."' order by stt asc,id desc ") ?>
							<li <?php echo $classActive = ($value['id'] == $id_active) ? 'class="active"' : '' ?>>
								<a href="<?php echo $value['tenkhongdau'] ?>">
									<?php echo $value['ten'] ?>
								</a>
								<?php if(!empty($cap2)) { ?>
									<ul class="sub-menu">
										<?php foreach( $cap2 as $key2 => $value2 ){ ?>
											<li>
												<a href="<?php echo $value2['tenkhongdau'] ?>">
													<?php echo $value2['ten'] ?>
												</a>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php } ?>
					<?php } ?>
					<li <?php echo $classActive = ($com == 'khung-gia-dat') ? 'class="active"' : '' ?>><a href="khung-gia-dat">Khung giá đất</a></li>
					<li <?php echo $classActive = ($com == 'tu-van-thiet-ke') ? 'class="active"' : '' ?>><a href="tu-van-thiet-ke">Tư vấn thiết kế</a></li>
					<li <?php echo $classActive = ($com == 'ky-gui') ? 'class="active"' : '' ?>><a href="ky-gui">Ký gửi</a></li>
					<li <?php echo $classActive = ($com == 'lien-he') ? 'class="active"' : '' ?>><a href="lien-he">Liên hệ</a></li>
				</ul>
			</nav>
			<div class="block-search">
				<form action="" method="POST" id="form-search">
					<button type="submit"></button>
					<input type="text" class="txt_keywords" value="<?php echo $_GET['keywords'] ?>" placeholder="Nhập từ khóa...">
				</form>
			</div>
		</div>
	</div>
</div>
<div id="hide-menu"></div>