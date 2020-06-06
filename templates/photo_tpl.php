<section class="section-main">
	<div class="container">
		<?php echo $breadcrumb ?>
		<?php if (empty($hinhanh)){ ?>
			<h4 class="oppp"><?php echo _dangcapnhat ?></h4>
		<?php } else { ?>
			<div class="grid grid-hinh-anh">
				<?php foreach($hinhanh as $key => $value) { ?>
					<div class="col-flex-3 col-hinh-anh wow fadeInUpSmall" data-wow-delay="<?php echo $key * 0.1 ?>s">
						
						<figure class="overflow-hidden">
							<a href="<?php echo _upload_hinhanh_l.$value['photo'] ?>" data-fancybox="gallery">
								<img data-src="thumb/290x266/1/<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>" class="img-full img-scale">
							</a>
						</figure>
						<h3 class="title-hinh-anh">
							<?php echo $value['ten'] ?>
						</h3>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>