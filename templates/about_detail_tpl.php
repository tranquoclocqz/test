<section class="section-main section-product">
	<div class="container">
		<div class="grid">
			<div class="col-flex-xl-9 col-flex-lg-9 col-flex-md-8">
				<?php echo $breadcrumb ?>
				<h1 class="the_title">
					<?php echo $row_detail['ten_'.$lang] ?>
				</h1>
				<?php if( !empty($row_detail['noidung_'.$lang]) ) { ?>
					<article class="noidung">
						<?php 
						echo $row_detail['noidung_'.$lang];
						echo '<div class="clearfix"></div>';
						?>
					</article>
				<?php } ?>
			</div>
			<div class="col-flex-xl-3 col-flex-lg-3 col-flex-md-4 hide-768">
				<?php include _template."layout/sidebar-right-gioi-thieu.php" ?>
			</div>
		</div>
	</div>
</section>