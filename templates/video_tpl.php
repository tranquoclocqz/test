<section class="section-main">
	<div class="container">
		<?php echo $breadcrumb ?>
		<div class="grid gallery">
			<?php foreach ($videos as $key => $value): ?>
				<div class="col-flex-3 col-video">
					<div class="video">
						<a data-fancybox href="https://www.youtube.com/watch?v=<?php echo getIDyoutube($value['links']) ?>" class="full"></a><img data-src="<?php echo getImgYoutube($value['links']) ?>" alt="<?php echo $value['ten'] ?>" class="img-full">
						<h3><?php echo $value['ten'] ?></h3>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>	
</section>