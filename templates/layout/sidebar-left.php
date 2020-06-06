<?php 
$link_san_pham = _result_array("SELECT ten,photo,url from table_lkweb where type like 'link-san-pham' and hienthi = 1 order by stt asc,id desc");
$dichvu = _result_array("SELECT ten_$lang as ten,tenkhongdau,id from table_baiviet where type like 'dich-vu' and hienthi = 1 order by stt asc,id desc");
$bannerqc = _result_array("SELECT ten_$lang as ten,link,photo_$lang as photo from table_photo where type like 'bannerqc' and hienthi = 1 order by stt asc,id desc");
?>
<div class="col-sticky">
	<div class="panel">
		<div class="panel-heading">
			<h3>
				sản phẩm
			</h3>
		</div>
		<div class="panel-body">
			<?php foreach ($link_san_pham as $key => $value) { ?>
				<a href="<?php echo $value['url'] ?>" class="tk-permalink" target="_blank"><?php echo $value['ten'] ?></a>
			<?php } ?>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading">
			<h3>
				Dịch vụ
			</h3>
		</div>
		<div class="panel-body">
			<?php foreach ($dichvu as $key => $value) { ?>
				<a href="<?php echo $value['tenkhongdau'] ?>" class="tk-permalink" ><?php echo $value['ten'] ?></a>
			<?php } ?>
		</div>
	</div>
	<div class="panel">
		<div class="panel-heading">
			<h3>
				THỐNG KÊ TRUY CẬP
			</h3>
		</div>
		<div class="panel-body">
			<div class="thong-ke">
				<div class="item-thong-ke"><img src="images/01_65.png" alt="đang online:">Đang online: <?php echo $count_online['dangxem'] ?></div>
				<div class="item-thong-ke"><img src="images/01_68.png" alt="Hôm qua:">Hôm qua: <?php echo $today_visitors ?></div>
				<div class="item-thong-ke"><img src="images/01_71.png" alt="Trong tuần:">Trong tuần: <?php echo $week_visitors ?></div>
				<div class="item-thong-ke"><img src="images/01_75.png" alt="Tổng:">Tổng: <?php echo $all_visitors ?></div>
			</div>
		</div>
	</div>
	<div class="slick-banner">
		<?php foreach($bannerqc as $key => $value) { ?>
			<div class="item-banner">
				<a href="<?php echo $value['link'] ?>" title="<?php echo $value['ten'] ?>"><img data-lazy="<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" class="img-full"></a>
			</div>
		<?php } ?>
	</div>
</div>