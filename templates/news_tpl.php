<section class="section-main section-product">
	<div class="container">
		<div class="bds">
			<div class="block-left">
				<?php include _template."layout/sidebar-left.php" ?>
			</div>
			<div class="block-center">
				<?php echo $breadcrumb; ?>
				<?php if( !empty($tintuc) ) { ?>
					<div class="grid grid-product">
						<?php foreach($tintuc as $key => $value) {
							echo tintuc3($value);
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
