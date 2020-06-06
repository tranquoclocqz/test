<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script>
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="#" onclick="return false;">Cập nhật title</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=option&act=save&type=<?php echo $_GET['type'] ?>" method="post" enctype="multipart/form-data">
		<?php  /* ?>
		<div class="widget">
			<div class="formRow lang_hidden lang_vi active">
				<label>Tên</label>
				<div class="formRight">
					<input type="text" name="ten_vi" title="Nhập nội dung" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<?php foreach ($ar_lang as $key => $value): ?>
				<div class="formRow lang_hidden lang_vi active">
					<label>Name</label>
					<div class="formRight">
						<input type="text" name="name_<?php echo $value['slug']?>" title="Nhập nội dung" id="name_<?php echo $value['slug']?>" class="tipS validate[required]" value="<?=@$item['name_'.$value['slug']]?>" />
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow lang_hidden lang_vi active">
					<label>Nội dung <br/> <?php echo $value['ten'] ?></label>
					<div class="formRight">
						<input type="text" name="value_<?php echo $value['slug']?>" title="Nhập nội dung" id="value_<?php echo $value['slug']?>" class="tipS validate[required]" value="<?=@$item['ten']?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endforeach; ?>
			<div class="formRow lang_hidden lang_vi active">
				<label>Tạo title</label>
				<div class="formRight">
					<button type="button" class="btn-tao blueB" class="blueB">Tạo title</button>
				</div>
				<div class="clear"></div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('.btn-tao').click(function(event) {
						var ten = $("#ten_vi").val();
						<?php foreach ($ar_lang as $key => $value): ?>
							var name_<?php echo $value['slug']?> = $("#name_<?php echo $value['slug']?>").val()
							var value_<?php echo $value['slug']?> = $("#value_<?php echo $value['slug']?>").val()
						<?php endforeach; ?>
						if (ten.length > 0
							<?php foreach ($ar_lang as $key => $value): ?> &&  value_<?php echo $value['slug']?>.length > 0 && name_<?php echo $value['slug']?>.length > 0  <?php endforeach; ?>) {
							$.ajax({
								type:'POST',
								url:'ajax/option-title.php',
								cache:false,
								data:{
									ten:ten,
									<?php foreach ($ar_lang as $key => $value): ?>
										name_<?php echo $value['slug']?>:name_<?php echo $value['slug']?>,
										value_<?php echo $value['slug']?>:value_<?php echo $value['slug']?>,
									<?php endforeach; ?>
									do: 'them',
									type:'<?php echo $_GET['type'] ?>',
								},
								success:function(data){
									$("#result").append(data);
								}
							});
					}
				});
				});
			</script>
		</div>  
		<?php */ ?>
		<div id="result">
			<?php foreach ($item as $key => $value): ?>
				<div class="widget">
					<div class="formRow lang_hidden lang_vi active">
						<div class="row">
							<div class="col-xs-12"  style="margin-bottom: 10px;font-weight: bold">
								<label><?php echo $value['ten_vi'] ?></label>
							</div>
						</div>
						<div class="item-capnhat">
							<?php foreach ($ar_lang as $key2 => $value2): ?>
								<div class="row" style="margin-bottom: 10px;">
									<div class="col-xs-12 col-sm-10">
										<input type="text" class="tipS input_<?php echo $value2['slug']?>" name="value_<?php echo $value2['slug'] ?>" data-name="<?php echo $value['name_'.$value2['slug']] ?>" value="<?php echo $value['value_'.$value2['slug']] ?>" />
									</div>
									<div class="col-xs-12 col-sm-2">
										<button type="button" data-id="<?php echo $value['id'] ?>" class="blueB btn-capnhat">Cập nhật</button>
									</div>
								</div>
							<?php endforeach ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</form>        
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('body').on('click', '.btn-capnhat', function(event) {
			event.preventDefault();
			var id = $(this).attr('data-id'), parent = $(this).parents('.item-capnhat');
			<?php foreach ($ar_lang as $key2 => $value2): ?>
				var value_<?php echo $value2['slug'] ?> = parent.find('input.input_<?php echo $value2['slug'] ?>').val();
			<?php endforeach ?>
			if (true <?php foreach ($ar_lang as $key2 => $value2): ?> && value_<?php echo $value2['slug'] ?>.length > 0 <?php endforeach ?>) {
				$.ajax({
					type:'POST',
					url:'ajax/option-title.php',
					cache:false,
					data:{
						id:id,
						<?php foreach ($ar_lang as $key2 => $value2): ?>
						value_<?php echo $value2['slug'] ?>: value_<?php echo $value2['slug'] ?>,
						<?php endforeach ?>
						do: 'capnhat',
						type:'<?php echo $_GET['type'] ?>',
					},
					success:function(data){
						if (data == 1) {
							alert('Cập nhật thành công !');
						} else {
							alert('Cập nhật thất bại ! vui lòng kiểm tra lại');
						}
					}
				});
			}
		});
	});
</script>