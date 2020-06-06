<?php 
$bannerqc2 = _result_array("SELECT ten_$lang as ten,link,photo_$lang as photo from table_photo where type like 'bannerqc2' and hienthi = 1 order by stt asc,id desc");
$yahoo = _result_array("SELECT ten_$lang as ten,dienthoai,yahoo as zalo,skype,viber,email from table_yahoo where type like 'ho-tro' and hienthi = 1 order by stt asc,id desc");
$tin_tuc = _result_array("SELECT ten_$lang as ten,mota_$lang as mota,photo,tenkhongdau from table_baiviet where type like 'tin-tuc' and hienthi = 1 and noibat = 1 order by stt asc,id desc");
$bgweb1 = _fetch_array("SELECT photo from table_bgweb where type like 'bgweb1'");
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
	<div class="panel">
		<div class="panel-heading">
			<h3>
				Nhà Đất bán
			</h3>
		</div>
		<div class="panel-body" >
			<div class="wrapper-tin-tuc-index" data-bg="url(<?php echo _upload_hinhanh_l.$bgweb1['photo'] ?>)">
				<h4>
					Chúng Tôi Hỗ trợ
				</h4>
				<div class="slick-tin-tuc">
					<?php foreach($tin_tuc as $key => $value) { ?>
						<div class="item-tin-tuc">
							<h3 class="title-tin-tuc-2">
								<a href="<?php echo $value['tenkhongdau'] ?>">
									<?php echo $value['ten'] ?>
								</a>
							</h3>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading">
			<h3>
				Quảng cáo
			</h3>
		</div>
		<div class="panel-body">
			<div class="slick-banner">
				<?php foreach($bannerqc2 as $key => $value) { ?>
					<div class="item-banner">
						<a href="<?php echo $value['link'] ?>" title="<?php echo $value['ten'] ?>"><img data-lazy="<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" class="img-full"></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>