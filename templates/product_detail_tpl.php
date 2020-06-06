<?php 
$product_width = '100';
$product_height = '125';
$ratio = 8;
$large = ( $product_width * $ratio ) .'x'. ($product_height * $ratio);
$thumb_x = ceil( $product_width * 1 ).'x'.ceil( $product_height * 1 );
$default_image = 'watermark/'.$thumb_x.'/1/';
$arr_photo = array(
	array('src' => 'watermark/'.$large.'/1/'._upload_product_l.$row_detail['photo'].'')
);
?>
<section class="section-main section-product">
	<div class="container">
		<div class="bds">
			<div class="block-left">
				<?php include _template."layout/sidebar-left.php" ?>
			</div>
			<div class="block-center">
				<?php echo $breadcrumb; ?>
				<!-- Hình ảnh chi tiết sản phẩm -->
				<div class="hinh-anh-san-pham">
					<div class="large-image">
						<a class="expand" data-index="0" href="watermark/<?php echo $large ?>/1/<?php echo _upload_product_l.$row_detail['photo'] ?>">
							<img data-src="watermark/<?php echo $large ?>/1/<?php echo _upload_product_l.$row_detail['photo'] ?>" alt="<?php echo $row_detail['ten_'.$lang] ?>" class="large-photo img-full">
						</a>
					</div>
					<div class="wrapper-small-image">
						<div class="small-image">
							<div class="slick-small-image">
								<div class="item-small-image">
									<a data-index="0" class="sub-photo" href="watermark/<?php echo $large ?>/1/<?php echo _upload_product_l.$row_detail['photo'] ?>">
										<img data-lazy="watermark/<?php echo $thumb_x ?>/1/<?php echo _upload_product_l.$row_detail['photo'] ?>" alt="<?php echo $row_detail['ten_'.$lang] ?>">
									</a>
								</div>
								<?php foreach($hinhanh_san_pham as $key => $value) {  array_push($arr_photo, array('src' => 'watermark/'.$large.'/1/'._upload_product_l.$value['photo'].'')) ?>
								<div class="item-small-image">
									<a data-index="<?php echo $key + 1 ?>" class="sub-photo" href="watermark/<?php echo $large ?>/1/<?php echo _upload_product_l.$value['photo'] ?>">
										<img data-lazy="watermark/<?php echo $thumb_x ?>/1/<?php echo _upload_product_l.$value['photo'] ?>" alt="<?php echo $row_detail['ten_'.$lang] ?>">
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- #Hình ảnh chi tiết sản phẩm -->
			<!-- Thông tin sản phẩm -->
			<div class="block-tab">
				<div class="thong-tin-san-pham">
					<div class="grid">
						<div class="col-flex-lg-6 col-flex-xl-6 col-flex-md-12">
							<h3 class="heading-product-detail">Mô tả</h3>
							<h1 class="product_detail_title">
								<?php echo $row_detail['ten_'.$lang] ?>
							</h1>
							<article class="noidung">
								<?php echo $row_detail['mota_'.$lang] ?>
							</article>
						</div>
						<div class="col-flex-lg-6 col-flex-xl-6 col-flex-md-12 box2">
							<div class="box-chi-tiet">
								<h3 class="heading-product-detail">Chi tiết dự án</h3>
								<div class="box-product-detail">
									<div class="tk-detail clearfix">
										<div class="tk-title">Giá Bán:</div>
										<div class="tk-content"><strong class="product_detail_giaban"><?php echo empty($row_detail['giaban']) ? '<a href="lien-he.html">Liên hệ</a>' : $row_detail['giaban'] ?></strong></div>
									</div>
									<div class="tk-detail clearfix">
										<div class="tk-title">Loại BĐS:</div>
										<div class="tk-content"><?php echo empty($row_detail['loainha']) ? 'Đang cập nhật' : $row_detail['loainha'] ?></div>
									</div>
									<div class="tk-detail clearfix">
										<div class="tk-title">Địa chỉ:</div>
										<div class="tk-content"><?php echo empty($row_detail['diachi']) ? 'Đang cập nhật' : $row_detail['diachi'] ?></div>
									</div>
									<div class="tk-detail clearfix">
										<div class="tk-title">Hướng:</div>
										<div class="tk-content"><?php echo empty($row_detail['huong']) ? 'Đang cập nhật' : $row_detail['huong'] ?></div>
									</div>
									<div class="tk-detail clearfix">
										<div class="tk-title">Diện tích:</div>
										<div class="tk-content"><?php echo empty($row_detail['dien_tich']) ? 'Đang cập nhật' : $row_detail['dien_tich'] ?></div>
									</div>
									<div class="tk-detail clearfix">
										<div class="tk-title">Ngày đăng:</div>
										<div class="tk-content"><?php echo date('d-m-Y',$row_detail['ngaytao']) ?></div>
									</div>
								</div>
							</div>
							<div class="box-lien-he">
								<h3 class="heading-product-detail">Liên hệ</h3>
								<div class="box-product-detail">
									<?php if( !empty($row_detail['ten_lien_lac']) ) { ?>
										<div class="tk-detail clearfix">
											<div class="tk-title">Tên liên lạc:</div>
											<div class="tk-content"><?php echo $row_detail['ten_lien_lac'] ?></div>
										</div>
									<?php } ?>
									<?php if( !empty($row_detail['ten_lien_lac']) ) { ?>
										<div class="tk-detail clearfix">
											<div class="tk-title">Địa Chỉ:</div>
											<div class="tk-content"><?php echo $row_detail['dia_chi_lien_lac'] ?></div>
										</div>
									<?php } ?>
									<?php if( !empty($row_detail['ten_lien_lac']) ) { ?>
										<div class="tk-detail clearfix">
											<div class="tk-title">Điện Thoại:</div>
											<div class="tk-content"><a href="tel:<?php echo replace_sodienthoai($row_detail['dien_thoai_lien_lac']) ?>"><?php echo $row_detail['dien_thoai_lien_lac'] ?></a></div>
										</div>
									<?php } ?>
									<?php if( !empty($row_detail['ten_lien_lac']) ) { ?>
										<div class="tk-detail clearfix">
											<div class="tk-title">Email:</div>
											<div class="tk-content"><a href="mailto:<?php echo $row_detail['email_lien_lac'] ?>"><?php echo $row_detail['email_lien_lac'] ?></a></div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #Thông tin sản phẩm -->
			<!-- Sản phẩm khác -->
			<?php if ($product['number'] != 0) { ?>
				<div class="block-tab">
					<div class="san_pham_lien_quan">
						<h3 class="title4">
							Dự án bất động sản khác
						</h3>
						<div id="result"></div>
					</div>
				</div>
			<?php } ?>
			<!-- #Sản phẩm khác -->
		</div>
		<div class="block-right">
			<?php include _template."layout/sidebar-right.php" ?>
		</div>
	</div>
</div>
</section>

<script>
	$(function() {
		less.pageLoadFinished.then(function(){
			function loadData(page){
				$.ajax({
					url: 'ajax/fetch_data_product.php',
					type: 'POST',
					data: {page: page,id:'<?php echo $row_detail['id'] ?>',idl:'<?php echo $row_detail['id_list'] ?>'},
					success:function(data){
						$("#result").html(data);
					}
				});
			}
			loadData(1);
			$("body").on('click', '.pagination li a', function(event) {
				event.preventDefault();
				var page = $(this).attr('p');
				if (page !== undefined) {
					loadData(page);
				}
			});
			$(".sub-photo").click(function(event) {
				event.preventDefault();
				$(".sub-photo").removeClass('active');
				$(this).addClass('active');
				var index = $(this).attr('data-index') , href = $(this).attr('href');
				$(".large-photo").attr('src',href);
				$(".expand").attr({ 'data-index': index });
			});
			$(".item-small").click(function(event) {
				$(".item-small").removeClass('mz-thumb-selected');
				$(this).addClass('mz-thumb-selected');
			});
			$(".expand").click(function(event) {
				event.preventDefault();
				var index = $(this).attr('data-index');
				$.fancybox.open(
					<?php echo json_encode($arr_photo) ?>,
					{
						loop : true,
					}, index 
					);
			});
			$(".slick-small-image").slick({
				slidesToShow: 8,
				vertical: false,
				verticalSwiping: false,
				slidesToScroll:1,
				arrows:true,
				prevArrow: '<span class="prevArrow"><i class="fa fa-angle-left" aria-hidden="true"></i></i></span>',
				nextArrow: '<span class="nextArrow"><i class="fa fa-angle-right" aria-hidden="true"></i></i></span>',
				dots:false,
				autoplay:false,
				autoplaySpeed:3000,
				speed:500,
				centerMode: true,
				centerPadding: 0,
				responsive: [
				{
					breakpoint: 993,
					settings: {
						slidesToShow: 6,
					}
				},
				{
					breakpoint: 401,
					settings: {
						slidesToShow: 4,
					}
				}
				]
			});
		});
	});
</script>