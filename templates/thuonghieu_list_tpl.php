<section class="section-main">
	<div class="container">
		<?php echo $breadcrumb ?>
		<?php if( !empty($thuonghieu) ) { ?>
			<div class="grid grid-thuong-hieu">
				<?php foreach($thuonghieu as $key => $value) { ?>
					<div class="col-flex-2 col-thuong-hieu">
						<div class="thuong-hieu">
							<figure>
								<a href="<?php echo $value['tenkhongdau'] ?>">
									<img data-src="thumb/220x126/2/<?php echo _upload_product_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>">
								</a>
							</figure>
							<h2>
								<a href="<?php echo $value['tenkhongdau'] ?>">
									<?php echo $value['ten'] ?>
								</a>
							</h2>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } else { ?>
			<h4 class="oppp">
				<?php echo _dangcapnhat ?>
			</h4>
		<?php } ?>
	</div>
</section>