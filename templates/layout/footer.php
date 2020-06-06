<div class="block-footer">
	<div class="container">
		<div class="footer">
			<div class="footer-1">
				<?php if (!preg_match('/detail/', $template)) { ?>
					<h1 class="site_name">
						<a href="<?php echo $url_web ?>">
							<?php echo $row_setting['ten_'.$lang] ?>
						</a>
					</h1>
				<?php } else { ?>
					<h2 class="site_name">
						<a href="<?php echo $url_web ?>">
							<?php echo $row_setting['ten_'.$lang] ?>
						</a>
					</h2>
				<?php } ?>
				<article class="noidung">
					<?php echo $footer['noidung'] ?>
				</article>
				<div class="socialfooter">
					<span>
						Follow us:
					</span>
					<?php foreach($socialfooter as $key => $value) { ?>
						<a href="<?php echo $value['url'] ?>"><img data-src="<?php echo _upload_hinhanh_l.$value['photo'] ?>" alt="<?php echo $value['ten'] ?>"></a>
					<?php } ?>
				</div>
			</div>
			<div class="footer-2">
				<h3 class="footer-title">Fanpage</h3>
				<div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-tabs="timeline"  data-width="500" data-height="180" data-small-header="true" data-adapt-container-width="true"  data-show-posts="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$row_setting['facebook']?>" class="fb-xfbml-parse-ignore"><a href="<?=$row_setting['facebook']?>">Facebook</a></blockquote></div>
			</div>
			<div class="footer-3">
				<h3 class="footer-title">Bản đồ</h3>
				<div class="footer-map">
					<iframe data-src="<?php echo match_iframe_src($row_setting['toado']) ?>" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copyright">
	<div class="container">
		<h2>
			2020 Copyright © <?php echo $row_setting['copyright'] ?> . Web Design by <a href="https://nina.vn">Nina.vn</a>
		</h2>
		<p>
			Đang online: <?php echo $count_online['dangxem'] ?> |  Tổng lượt truy cập : <?php echo $all_visitors ?>
		</p>
	</div>
</div>
<a href="javascript:void(0);" id="back_to_top">
	<i class="fa fa-2x fa-arrow-up" aria-hidden="true"></i>
</a>