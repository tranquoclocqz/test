<div class="container-bds">
	<div class="container">
		<div class="bds">
			<div class="block-left">
				<?php include _template."layout/sidebar-left.php" ?>
			</div>
			<div class="block-center">
				<?php foreach($danh_muc_san_pham_index as $key => $value) { ?>
					<div class="block-bds">
						<div class="title">
							<h3>
								<a href="<?php echo $value['tenkhongdau'] ?>"><?php echo $value['ten'] ?></a>
							</h3>
						</div>
						<div class="show-result" data-id="<?php echo $value['id'] ?>"></div>
					</div>
				<?php } ?>
			</div>
			<div class="block-right">
				<?php include _template."layout/sidebar-right.php" ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		function fetch_data(page,id,target){
			$.ajax({
				url: 'ajax/fetch_data.php',
				type: 'POST',
				data: {page: page,id: id},
				success:function(response){
					target.html(response);
				}
			});
		}
		$(".show-result").each(function(index, el) {
			fetch_data(1,$(this).attr('data-id'),$(this));	
		});
		$("body").on('click', '.pagination li a', function(event) {
			event.preventDefault();
			var page = $(this).attr('p'), id = $(this).attr('data-key'), target = $(this).parents('.show-result');
			if (typeof page !== 'undefined') {
				fetch_data(page,id,target);
			}
		});
	});
</script>