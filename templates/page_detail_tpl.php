<section class="section-main">
	<div class="container">
		<?php if (empty($affix)): ?>
			<h4 class="oppp">Nội dung đang cập nhật</h4>
			<?php else: ?>
				<div class="row">
					<div class="col-xs-3 is-sticky">
						<div class="affix">
							<ul>
								<?php foreach ($affix as $key => $value): ?>
									<li <?php echo $classActive = ($key == 0) ? 'class="active"' : '' ?>>
										<a href="javascript:void(0);" onclick="goToByScroll(this)" data-scroll="#section-<?php echo $value['tenkhongdau'] ?>"><?php echo $value['ten'] ?></a>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
					<div class="col-xs-9">
						<?php foreach ($affix as $key => $value): ?>
							<section class="section-spy" id="section-<?php echo $value['tenkhongdau'] ?>">
								<h2 class="posts-title">
									<?php echo $value['ten']?>
								</h2>
								<article class="noidung"><?php echo $value['noidung'] ?></article>
							</section>
						<?php endforeach ?>
					</div>
				</div>
			<?php endif ?>
		</div>
	</section>