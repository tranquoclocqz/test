<section class="section-main section-product">
	<div class="container">
		<div class="bds">
			<div class="block-left">
				<?php include _template."layout/sidebar-left.php" ?>
			</div>
			<div class="block-center">
				<?php echo $breadcrumb; ?>
				<h1 class="the_title">
					<?php echo $row_detail['ten_'.$lang] ?>
				</h1>
				<div class="wrapper-single">
					<?php if( !empty($row_detail['noidung_'.$lang]) ) { ?>
						<article class="noidung" style="margin-top: 15px;">
							<?php 
							echo $row_detail['noidung_'.$lang];
							echo '<div class="clearfix"></div>';
							?>
						</article>
					<?php } ?>
				</div>
				<?php if (!empty($hinhanh)){ ?>
					<div class="grid grid-hinh-anh">
						<?php foreach($hinhanh as $key => $value) { ?>
							<div class="col-flex-3 wow fadeInUpSmall" data-wow-delay="<?php echo $key * 0.1 ?>s">
								<figure class="overflow-hidden">
									<a href="<?php echo _upload_baiviet_l.$value['photo'] ?>" data-fancybox="gallery">
										<img data-src="thumb/290x200/1/<?php echo _upload_baiviet_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" class="img-full">
									</a>
								</figure>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php include _template."layout/share_social.php" ?>
				<?php if (!empty($tintuc)){ ?>
					<div class="title-al">
						<h3><?php echo _baivietkhac ?></h3>
					</div>
					<div class="grid grid-tin-tuc">
						<?php foreach ($tintuc as $key => $value) {
							echo tintuc3($value);
						} ?>
					</div>	
				<?php } ?>
			</div>
			<div class="block-right">
				<?php include _template."layout/sidebar-right.php" ?>
			</div>
		</div>
	</div>
</section>
