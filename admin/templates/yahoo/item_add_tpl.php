<script type="text/javascript">	
	function TreeFilterChanged1(){
		$('#validate').submit();
	}
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
				<li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=yahoo&act=save&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="title chonngonngu">
				<ul>
					<?php foreach ($ar_lang as $key => $value): ?>
						<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['img'] ?>" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>	
			<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
				<h6>Nhập dữ liệu</h6>
			</div>		
			<?php foreach ($ar_lang as $key => $value): ?>
			<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<label>Tiêu đề <br> <?php echo $value['ten'] ?></label>
				<div class="formRight">
					<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên nhân viên hỗ trợ" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
				</div>
				<div class="clear"></div>
			</div>		
			<?php endforeach ?>	
			<div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
					<input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS validate[required]" value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Email</label>
				<div class="formRight">
					<input type="text" name="email" title="Nhập email" id="email" class="tipS validate[required]" value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<?php if ($config_social): ?>
			<div class="formRow">
				<label>Facebook</label>
				<div class="formRight">
					<input type="text" name="facebook" title="Nhập facebook" id="facebook" class="tipS validate[required]" value="<?=@$item['facebook']?>" />
					<span class="note">Nhập link message facebook</span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Zalo</label>
				<div class="formRight">
					<input type="text" name="yahoo" title="Nhập số điện thoại zalo" id="yahoo" class="tipS validate[required]" value="<?=@$item['yahoo']?>" />
					<span class="note">Nhập số điện thoại zalo</span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Skype</label>
				<div class="formRight">
					<input type="text" name="skype" title="Nhập Skype" id="skype" class="tipS validate[required]" value="<?=@$item['skype']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Viber</label>
				<div class="formRight">
					<input type="text" name="viber" title="Nhập Viber" id="viber" class="tipS validate[required]" value="<?=@$item['viber']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<?php endif ?>
			<div class="formRow">
				<label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
				<div class="formRight">

					<input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label for="check1">Hiển thị</label>            
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Số thứ tự: </label>
				<div class="formRight">
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="id" id="id_this_yahoo" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>  
	</form></div>