
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
				<li><a href="index.php?com=tieude&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=tieude&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
					<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				</div>
				<div class="clear"></div>
			</div>
			<?php if($_GET['act']=='edit'){?>
				<div class="formRow">
					<label>Hình Hiện Tại :</label>
					<div class="formRight">
						<div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>?v=<?php echo time() ?>"  alt="NO PHOTO" style="max-width: 600px" /></div>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if( $config['edit'] ) { ?>
				<div class="formRow lang_hidden lang_vi active">
					<label>Type</label>
					<div class="formRight">
						<input type="text" name="type" title="Nhập type" id="title" readonly class="tipS" value="<?=@$item['type']?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if( $config_background ) { ?>
				<div class="formRow">
					<label>Background:</label>
					<div class="formRight">
						<input type="file" id="file2" name="file2" />
						<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
						<?php if( !$config_auto ) { ?>
							<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Background :</label>
						<div class="formRight">
							<div class="mt10"><img src="<?=_upload_hinhanh.$item['background']?>"  alt="NO PHOTO"/></div>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="formRow lang_hidden lang_vi active">
				<label>Title</label>
				<div class="formRight">
					<input type="text" name="title" title="Nhập tên danh mục" id="title" class="tipS validate[required]" value="<?=@$item['title']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_vi active">
				<label>Keywords</label>
				<div class="formRight">
					<textarea name="keywords" id="" cols="30" rows="5"><?=@$item['keywords']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow lang_hidden lang_vi active">
				<label>Description</label>
				<div class="formRight">
					<textarea name="description" id="" cols="30" rows="5"><?=@$item['description']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
		</div>  
		<div class="widget">


			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=tieude&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        </div>
