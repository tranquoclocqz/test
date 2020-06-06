<section class="section-main section-product">
	<div class="container">
		<div class="bds">
			<div class="block-left">
				<?php include _template."layout/sidebar-left.php" ?>
			</div>
			<div class="block-center">
				<?php echo $breadcrumb; ?>
				<?php if( !empty($product) ) { ?>
					<div class="grid grid-product">
						<?php foreach($product as $key => $value) {
							echo sanpham($value);
						} ?>
					</div>
					<div class="text-center"><?php echo $paging ?></div>
				<?php } else { ?>
					<h4 class="oppp">
						<?php echo _dangcapnhat ?>
					</h4>
				<?php } ?>
			</div>
			<div class="block-right">
				<?php include _template."layout/sidebar-right.php" ?>
			</div>
		</div>
	</div>
</section>
