<?php
$bannerqc2 = _result_array("SELECT ten_$lang as ten,link,photo_$lang as photo from table_photo where type like 'bannerqc2' and hienthi = 1 order by stt asc,id desc");
$yahoo = _result_array("SELECT ten_$lang as ten,dienthoai,yahoo as zalo,skype,viber,email from table_yahoo where type like 'ho-tro' and hienthi = 1 order by stt asc,id desc");
$tin_tuc = _result_array("SELECT ten_$lang as ten,mota_$lang as mota,photo,tenkhongdau from table_baiviet where type like 'tin-tuc' and hienthi = 1 and noibat = 1 order by stt asc,id desc");
$ykkh = _result_array("SELECT ten_$lang as ten,mota_$lang as mota,photo from table_baiviet where type like 'y-kien-khach-hang' and hienthi = 1 order by stt asc,id desc");
?>
<div class="col-sticky">
	<div class="panel">
		<div class="panel-heading">
			<h3>
				hỗ trợ hotline
			</h3>
		</div>
		<div class="panel-body">
			<div class="block-ho-tro">
				<img src="images/img-ho-tro.png" alt="hỗ trợ hotline">
				<div class="grid-ho-tro">
					<?php foreach ($yahoo as $key => $value): ?>
						<div class="item-ho-tro">
							<a href="<?php echo $value['skype'] ?>"><img src="images/skype.png" alt="Skype"></a>
							<a href="viber://pa?chatURI=<?php echo replace_sodienthoai($value['viber']) ?>"><img src="images/viber.png" alt="viber"></a>
							<a href="https://zalo.me/<?php echo replace_sodienthoai($value['zalo']) ?>"><img src="images/zalo.png" alt="Zalo"></a>
							<p class="tel">
								<?php echo $value['ten'] ?> <strong><a href="tel:<?php echo replace_sodienthoai($value['dienthoai']) ?>"><?php echo $value['dienthoai'] ?></a></strong>
							</p>
							<p class="envelope">
								<img src="images/envelope.png" alt="Email"> <a href="mailto:<?php echo $value['email'] ?>"><?php echo $value['email'] ?></a>
							</p>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
	<?php if( !empty($ykkh) ) { ?>
		<div class="panel">
			<div class="panel-heading">
				<h3>
					Cảm nhận khách hàng
				</h3>
			</div>
			<div class="panel-body">
				<div class="wrapper-y-kien-khach-hang">
					<div class="slick-y-kien-khach-hang">
						<?php foreach($ykkh as $key => $value) { ?>
							<div class="item-y-kien-khach-hang">
								<div class="y-kien-khach-hang">
									<img data-lazy="thumb/80x80/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
									<h3>
										<?php echo $value['ten'] ?>
									</h3>
									<p><?php echo catchuoi($value['mota'],300) ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if( !empty($tin_tuc) ) { ?>
		<div class="panel">
			<div class="panel-heading">
				<h3>
					Tin tức
				</h3>
			</div>
			<div class="panel-body">
				<div class="wrapper-tin-tuc">
					<div class="slick-tin-tuc">
						<?php foreach($tin_tuc as $key => $value) { ?>
							<div class="item-tin-tuc">
								<div class="tin-tuc-sidebar">
									<figure>
										<a href="<?php echo $value['tenkhongdau'] ?>">
											<img data-lazy="thumb/150x110/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
										</a>
									</figure>
									<div>
										<h3>
											<a href="<?php echo $value['tenkhongdau'] ?>">
												<?php echo $value['ten'] ?>
											</a>
										</h3>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>