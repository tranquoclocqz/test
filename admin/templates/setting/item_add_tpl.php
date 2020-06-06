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
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=setting&act=capnhat"><span>Thiết lập hệ thống</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Cấu hình website</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=setting&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	

	<div class="widget">

		<div class="title chonngonngu">
			<ul>
				<?php foreach ($ar_lang as $key => $value): ?>
					<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>	
		<?php foreach ($ar_lang as $key => $value): ?>
			<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<label>Tên Công Ty <br/> <?php echo $value['ten'] ?> </label>
				<div class="formRight">
					<input type="text" name="ten_<?php echo $value['slug'] ?>" title="Nhập tên công ty <?php echo $value['ten'] ?>" id="ten_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['ten_'.$value['slug']]?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<label>Slogan <br/> <?php echo $value['ten'] ?> </label>
				<div class="formRight">
					<input type="text" name="slogan_<?php echo $value['slug'] ?>" title="Nhập slogan <?php echo $value['ten'] ?>" id="slogan_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@($item['slogan_'.$value['slug']])?>" />
				</div>
				<div class="clear"></div>
			</div>


			<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<label>Địa chỉ <br/> <?php echo $value['ten'] ?></label>
				<div class="formRight">
					<input type="text" name="diachi_<?php echo $value['slug'] ?>" title="Nhập địa chỉ công ty" id="diachi_<?php echo $value['slug'] ?>" class="tipS validate[required]" value="<?=@$item['diachi_'.$value['slug']]?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach ?>
		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập địa chỉ email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Hotline</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['hotline']?>" name="hotline" title="Nhập hotline" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập số điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Zalo</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['zalo']?>" name="zalo" title="Nhập số điện thoại zalo" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Facebook fanpage</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['facebook']?>" name="facebook" title="Nhập facebook fanpage" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Chat Fanpage Facebook </label>
			<div class="formRight">
				<input type="text" value="<?=@$item['facebook2']?>" name="facebook2" title="Nhập facebook fanpage" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Website</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['website']?>" name="website" title="Nhập địa chỉ website" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Copyright</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['copyright']?>" name="copyright" title="Nhập copyright" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<?php if (true): ?>
			<div class="formRow">
				<label for="diachi">Screenshot</label>
				<div class="formRight">
					<input type="file" name="screenshot">	
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="File hình">
					<div class="clear"></div>
				</div>			
				<div class="clear"></div>
			</div>
			<?php if (!empty($item['screenshot'])): ?>
				<div class="formRow">
					<label for="diachi"></label>
					<div class="formRight">
						<img style="background-color: #cccccc;max-width: 100%;" src="<?php echo _upload.$item['screenshot'] ?>?v=<?php echo time() ?>" alt="">
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<div class="formRow">
				<label for="diachi">Tiêu đề trang web</label>
				<div class="formRight">
					<input id="title_website" name="title_website" type="text" value="<?=$item['title_website']?>" />
				</div>			
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label for="diachi">Mô tả</label>
				<div class="formRight">
					<input id="description_website" name="description_website" type="text" value="<?=$item['description_website']?>" />
				</div>			
				<div class="clear"></div>
			</div>
		<?php endif ?>
		<?php if (true): ?>
			<div class="formRow">
				<label>iFrame bản đồ</label>
				<div class="formRight">
					<textarea name="toado" id="" cols="30" rows="10"><?php echo $item['toado'] ?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<?php if (!empty($item['toado'])): ?>
				<div class="formRow">
					<div class="map-wrapper">
						<?php echo $item['toado'] ?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
		<?php endif ?>
		<?php if (false): ?>
			<div class="formRow">
				<label for="diachi">Logo bộ công thương</label>
				<div class="formRight">
					<input type="file" name="file_bocongthuong">	
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="File hình">
					<div class="note">Chỉ file hình png 235px x 88px</div>
					<div class="clear"></div>
				</div>			
				<div class="clear"></div>
			</div>
			<?php if (!empty($item['bocongthuong'])): ?>
				<div class="formRow">
					<label for="diachi"></label>
					<div class="formRight">
						<img style="background-color: #cccccc" src="../thumb/235x88/2/<?php echo _upload_l.$item['bocongthuong'] ?>" alt="">
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>
			<div class="formRow">
				<label for="diachi">Link bộ công thương</label>
				<div class="formRight">
					<input id="link_bocongthuong" name="link_bocongthuong" type="text" value="<?=$item['link_bocongthuong']?>" />
				</div>			
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label for="diachi">Hiển thị bộ công thương</label>
				<div class="formRight">
					<input id="hienthi" name="hienthi" type="checkbox" <?= ($item['hienthi'] == 0) ? '' : 'checked' ?> />
				</div>			
				<div class="clear"></div>
			</div>
		<?php endif ?>
		
		<?php if (true) {  $product_width = '100'; $product_height = '125';$raito = 8; ?>
		<div class="formRow">
			<label for="diachi">Đóng dấu sản phẩm</label>
			<div class="formRight">
				<input type="file" name="watermark">	
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Chỉ file hình png">
				<div class="note">Chỉ file hình png <?php echo $product_width*$raito ?>px x <?php echo $product_height*$raito ?>px</div>
				<div class="clear"></div>
			</div>			
			<div class="clear"></div>
		</div>
		<?php if (!empty($item['watermark'])): ?>

			<div class="formRow">
				<label for="diachi">Hình đóng dấu</label>
				<div class="formRight">
					<img style="background-color: #cccccc;max-width: <?php echo $product_width * 3 ?>px;display: block" src="<?php echo _upload.$item['watermark'] ?>?v=<?php echo time() ?>" alt="">						
				</div>
				<div class="clear"></div>
			</div>
		<?php endif ?>
	<?php } ?>
</div>
<div class="widget">
	<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
		<h6>Nội dung seo</h6>
	</div>
	<div class="title chonngonngu">
		<ul>
			<?php foreach ($ar_lang as $key => $value): ?>
				<li><a href="<?php echo $value['slug'] ?>" class="<?php echo $value['active'] ?> tipS validate[required]" title="Chọn <?php echo $value['ten'] ?>"><img src="./images/<?php echo $value['slug'] ?>.png" alt="" class="tiengviet" /><?php echo $value['ten'] ?></a></li>
			<?php endforeach ?>
		</ul>
	</div>		
	<?php foreach ($ar_lang as $key => $value){ ?>
		<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
			<label>Title <br> <?php echo $value['ten'] ?></label>
			<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<input type="text" value="<?=@$item['title_'.$value['slug']]?>" name="title_<?php echo $value['slug'] ?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
			<label>Từ khóa <br> <?php echo $value['ten'] ?></label>
			<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<input type="text" value="<?=@$item['keywords_'.$value['slug']]?>" name="keywords_<?php echo $value['slug'] ?>" title="Từ khóa chính cho danh mục" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
			<label>Description <br> <?php echo $value['ten'] ?></label>
			<div class="formRight lang_hidden lang_<?php echo $value['slug'] ?> <?php echo $value['active'] ?>">
				<textarea rows="4" class="description" cols="<?php echo $value['slug']?>" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description_<?php echo $value['slug'] ?>"><?=@$item['description_'.$value['slug']]?></textarea>
				<input readonly="readonly" type="text" name="des_char" class="des_char_<?php echo $value['slug']?>" value="<?=@$item['des_char_'.$value['slug']]?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>
	<?php } ?>

	<div class="formRow">
		<label>Analyrics:</label>
		<div class="formRight">
			<textarea rows="8" cols="" title="Code Analytics" class="tipS" name="analytics"><?=@unzip_chuanhoa($item['analytics'])?></textarea>
		</div>
		<div class="clear"></div>
	</div>	

	<div class="formRow">
		<label>V chat :</label>
		<div class="formRight">
			<textarea rows="8" cols="" title="Code vchat" class="tipS" name="vchat"><?=@unzip_chuanhoa($item['vchat'])?></textarea>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="formRow">
		<label>Meta:</label>
		<div class="formRight">
			<textarea rows="8" cols="" title="meta" class="tipS" name="meta"><?=@$item['meta']?></textarea>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="formRow">
		<label>Script top :</label>
		<div class="formRight">
			<textarea rows="8" cols="" title="script top" class="tipS" name="scripttop"><?=@unzip_chuanhoa($item['scripttop'])?></textarea>
		</div>
		<div class="clear"></div>
	</div>	

	<div class="formRow">
		<label>Script bottom :</label>
		<div class="formRight">
			<textarea rows="8" cols="" title="script bottom" class="tipS" name="scriptbottom"><?=@unzip_chuanhoa($item['scriptbottom'])?></textarea>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<div class="formRight">
			<input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
			<input type="submit" class="blueB"  value="Hoàn tất" />
		</div>
		<div class="clear"></div>
	</div>
</div>


</form>  